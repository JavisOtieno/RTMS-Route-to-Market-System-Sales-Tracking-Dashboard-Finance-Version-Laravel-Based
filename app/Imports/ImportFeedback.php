<?php

namespace App\Imports;

use App\Models\Route;
use App\Models\Visit;
use App\Models\Region;
use App\Models\Cluster;
use App\Models\Feedback;
use App\Models\Territory;
use Google\Service\Classroom\Feed;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;



class ImportFeedback implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // return new Route([
        //     //
        // ]);
        // $region = Region::firstOrCreate(
        //     ['name' => $row[0]], // Correctly access 'REGION' from the imported row
        //     ['name' => $row[0]]
        // );
        // $region = Region::where('name', $row[0])->first(); 
        // dd('Row Data: ', $row);
        // $region = Region::where(DB::raw('LOWER(name)'), '=', strtolower('TestTest'))->first();
        // $region = Region::find(3);
        // $region = Region::where(DB::raw('LOWER(name)'),strtolower($row[0]))->first();
        // $region = Region::where(DB::raw('LOWER(name)'), '=', strtolower(trim($row[0])))->first();
        // $territory = Territory::where(DB::raw('LOWER(name)'), '=', strtolower(trim($row[1])))->first();
        // $cluster = Cluster::where(DB::raw('LOWER(name)'), '=', strtolower(trim($row[2])))->first();
        $visitid = strtolower(trim($row[0]));
        $visit = Visit::where('id', $visitid);
        $outlet_id = $visit->value('outlet_id');
        $user_id = $visit->value('user_id');
        $organization_id = $visit->value('organization_id');
        $team_id = $visit->value('team_id');

        $feedback = $row[1];

        function durationToSeconds(?string $duration): int
        {
            if (empty($duration)) {
                return -1; // signal "null/empty"
            }

            $parts = array_reverse(explode(':', trim($duration)));
            $seconds = 0;

            if (isset($parts[0])) $seconds += (int) $parts[0];          // seconds
            if (isset($parts[1])) $seconds += (int) $parts[1] * 60;     // minutes
            if (isset($parts[2])) $seconds += (int) $parts[2] * 3600;   // hours

            return $seconds;
        }

        $durationSeconds = durationToSeconds($visit->duration);

        if ($durationSeconds === -1) {
            // null or empty → use max = 2 minutes
            $randSeconds = random_int(1, 120);
        } elseif ($durationSeconds === 0) {
            // duration = zero → add 0 seconds
            $randSeconds = 0;
        } else {
            // duration > 0 → pick between 1 and that duration
            $randSeconds = random_int(1, $durationSeconds);
        }

        $createdat = $visit->created_at->copy()->addSeconds($randSeconds);
        $updatedat = $visit->created_at->copy()->addSeconds($randSeconds);

        // dd($row);
             
            return new Feedback([
                'outlet_id' => $outlet_id,
                'visit_id' => $visitid,
                'user_id' =>$user_id,
                'feedback' => $feedback,
                'organization_id' =>$organization_id,
                'team_id' =>$team_id,
                'created_at' => $createdat,
                'updated_at' => $updatedat,
            ]);
        
    }

}
