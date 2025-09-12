<?php

// namespace App\Imports;

// use App\Models\Route;
// use App\Models\Visit;
// use App\Models\Region;
// use App\Models\Cluster;
// use App\Models\Feedback;
// use App\Models\Territory;
// use Google\Service\Classroom\Feed;
// use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Concerns\ToModel;



// class ImportFeedback implements ToModel
// {
//     /**
//     * @param array $row
//     *
//     * @return \Illuminate\Database\Eloquent\Model|null
//     */
//     public function model(array $row)
//     {
//         // return new Route([
//         //     //
//         // ]);
//         // $region = Region::firstOrCreate(
//         //     ['name' => $row[0]], // Correctly access 'REGION' from the imported row
//         //     ['name' => $row[0]]
//         // );
//         // $region = Region::where('name', $row[0])->first(); 
//         // dd('Row Data: ', $row[0]);
//         // $region = Region::where(DB::raw('LOWER(name)'), '=', strtolower('TestTest'))->first();
//         // $region = Region::find(3);
//         // $region = Region::where(DB::raw('LOWER(name)'),strtolower($row[0]))->first();
//         // $region = Region::where(DB::raw('LOWER(name)'), '=', strtolower(trim($row[0])))->first();
//         // $territory = Territory::where(DB::raw('LOWER(name)'), '=', strtolower(trim($row[1])))->first();
//         // $cluster = Cluster::where(DB::raw('LOWER(name)'), '=', strtolower(trim($row[2])))->first();
//         $visitid = strtolower(trim($row[0]));
//         $visit   = Visit::find($visitid);

//         if ($visit) {
//             $outlet_id       = $visit->outlet_id;
//             $user_id         = $visit->user_id;
//             $organization_id = $visit->organization_id;
//             $team_id         = $visit->team_id;
//         }
//         $feedback = $row[1];

//         function durationToSeconds(?string $duration): int
//         {
//             if (empty($duration)) {
//                 return -1; // signal "null/empty"
//             }

//             $parts = array_reverse(explode(':', trim($duration)));
//             $seconds = 0;

//             if (isset($parts[0])) $seconds += (int) $parts[0];          // seconds
//             if (isset($parts[1])) $seconds += (int) $parts[1] * 60;     // minutes
//             if (isset($parts[2])) $seconds += (int) $parts[2] * 3600;   // hours

//             return $seconds;
//         }

//         $durationSeconds = durationToSeconds($visit->duration);

//         if ($durationSeconds === -1) {
//             // null or empty → use max = 2 minutes
//             $randSeconds = random_int(1, 120);
//         } elseif ($durationSeconds === 0) {
//             // duration = zero → add 0 seconds
//             $randSeconds = 0;
//         } else {
//             // duration > 0 → pick between 1 and that duration
//             $randSeconds = random_int(1, $durationSeconds);
//         }

//         $createdat = $visit->created_at->copy()->addSeconds($randSeconds);
//         $updatedat = $visit->created_at->copy()->addSeconds($randSeconds);

//         // dd($row);
             
//             return new Feedback([
//                 'outlet_id' => $outlet_id,
//                 'visit_id' => $visitid,
//                 'user_id' =>$user_id,
//                 'feedback' => $feedback,
//                 'organization_id' =>$organization_id,
//                 'team_id' =>$team_id,
//                 'created_at' => $createdat,
//                 'updated_at' => $updatedat,
//             ]);
        
//     }

// }

namespace App\Imports;

use App\Models\Visit;
use App\Models\Feedback;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ImportFeedback implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
     * Process one row from the sheet.
     *
     * WithHeadingRow allows you to refer to columns by header names (lowercased/slugged by default).
     */
    public function model(array $row)
    {
        // Get visit id either from header 'visit_id' or index 0
        $visitid = trim((string) ($row['visit_id'] ?? $row[0] ?? ''));

        if ($visitid === '') {
            Log::warning('Skipping row: empty visit id', ['row' => $row]);
            return null; // skip this row
        }

        $visit = Visit::find($visitid);

        if (! $visit) {
            Log::warning('Skipping row: Visit not found', ['visit_id' => $visitid, 'row' => $row]);
            return null; // or handle differently if you want to create placeholder
        }

        // Normalize the feedback text (cast to string first)
        $feedbackText = $this->normalizeText($row['feedback'] ?? $row[1] ?? '');

        // Compute duration seconds safely (guard if visit->duration is missing)
        $durationSeconds = $this->durationToSeconds($visit->duration ?? null);

        if ($durationSeconds === -1) {
            $randSeconds = random_int(1, 120); // fallback max = 2 minutes
        } elseif ($durationSeconds === 0) {
            $randSeconds = 0;
        } else {
            // random between 1 and durationSeconds (if durationSeconds >= 1)
            $randSeconds = random_int(1, max(1, $durationSeconds));
        }

        // Safe created_at/updated_at calculation
        $createdAt = $visit->created_at ? $visit->created_at->copy()->addSeconds($randSeconds) : now();

        return new Feedback([
            'outlet_id'       => $visit->outlet_id,
            'visit_id'        => $visitid,
            'user_id'         => $visit->user_id,
            'feedback'        => $feedbackText,
            'organization_id' => $visit->organization_id,
            'team_id'         => $visit->team_id,
            'created_at'      => $createdAt,
            'updated_at'      => $createdAt,
        ]);
    }

    /**
     * Normalize incoming text from Excel cells.
     * - Casts to string, removes BOM, decodes entities, removes control chars,
     *   collapses whitespace, trims, normalizes unicode (if available).
     * - Returns null for empty strings.
     */
    private function normalizeText($value): ?string
    {
        if (is_null($value)) {
            return null;
        }

        // cast to string (numeric cells will become their textual representation)
        $value = (string) $value;

        // remove UTF-8 BOM if present
        $value = preg_replace('/^\x{FEFF}/u', '', $value);

        // try to ensure UTF-8 (auto-detect)
        if (! mb_check_encoding($value, 'UTF-8')) {
            $value = mb_convert_encoding($value, 'UTF-8', 'auto');
        }

        // normalize unicode if Normalizer available (optional but recommended)
        if (class_exists('\Normalizer')) {
            $normalized = \Normalizer::normalize($value, \Normalizer::FORM_C);
            if ($normalized !== false) {
                $value = $normalized;
            }
        }

        // decode HTML entities (if your cells have &amp; etc)
        $value = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // remove control characters except newline and tab (optional)
        $value = preg_replace('/[\x00-\x08\x0B-\x0C\x0E-\x1F\x7F]/u', '', $value);

        // collapse multiple whitespace (newlines/tabs to single space) and trim
        $value = preg_replace('/\s+/u', ' ', $value);
        $value = trim($value);

        return $value === '' ? null : $value;
    }

    /**
     * Convert duration text (hh:mm:ss or mm:ss or ss) to seconds.
     * Return -1 if null/empty to indicate "use fallback".
     */
    private function durationToSeconds(?string $duration): int
    {
        if (empty($duration)) {
            return -1; // signal "null/empty"
        }

        // Normalize and ensure it's a string
        $duration = trim((string) $duration);

        // support formats like HH:MM:SS, MM:SS, SS
        $parts = array_reverse(explode(':', $duration));
        $seconds = 0;

        if (isset($parts[0])) $seconds += (int) $parts[0];          // seconds
        if (isset($parts[1])) $seconds += (int) $parts[1] * 60;     // minutes
        if (isset($parts[2])) $seconds += (int) $parts[2] * 3600;   // hours

        return $seconds;
    }

    /**
     * Chunk size when reading large files.
     */
    public function chunkSize(): int
    {
        return 1000;
    }
}
