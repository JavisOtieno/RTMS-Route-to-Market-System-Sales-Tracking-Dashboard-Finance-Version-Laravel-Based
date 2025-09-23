<?php
namespace App\Exports;

use App\Models\Clockin;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Log;

class ClockinsExportDatatables implements FromQuery, WithHeadings, WithChunkReading, WithMapping
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
        Log::info('Export Filters Received:', $filters);
    }

    public function query()
    {
        $query = Clockin::with(['user', 'user.team', 'user.region', 'user.territory', 'user.cluster'])
            ->select('clockins.*')
            ->whereNull('clockins.deleted_at'); // Handle soft deletes

        // Apply global search filter
        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('clockins.id', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhereHas('team', function ($q) use ($search) {
                                $q->where('name', 'like', "%{$search}%");
                            })
                            ->orWhereHas('region', function ($q) use ($search) {
                                $q->where('name', 'like', "%{$search}%");
                            })
                            ->orWhereHas('territory', function ($q) use ($search) {
                                $q->where('name', 'like', "%{$search}%");
                            })
                            // ->orWhereHas('cluster', function ($q) use ($search) {
                            //     $q->where('name', 'like', "%{$search}%");
                            // })
                            ;
                    })
                    ->orWhere('clockins.lat', 'like', "%{$search}%")
                    ->orWhere('clockins.long', 'like', "%{$search}%");
            });
        }

        // Apply column-specific filters
        if (!empty($this->filters['columns'])) {
            foreach ($this->filters['columns'] as $column => $value) {
                if ($value !== '' && $column !== 'actions') {
                    switch ($column) {
                        case 'id':
                            $query->where('clockins.id', 'like', "%{$value}%");
                            break;
                        case 'user_name':
                            $query->whereHas('user', function ($q) use ($value) {
                                $q->where('name', 'like', "%{$value}%");
                            });
                            break;
                        case 'team_name':
                            $query->whereHas('user.team', function ($q) use ($value) {
                                $q->where('name', 'like', "%{$value}%");
                            });
                            break;
                        case 'region_name':
                            $query->whereHas('user.region', function ($q) use ($value) {
                                $q->where('name', 'like', "%{$value}%");
                            });
                            break;
                        case 'territory_name':
                            $query->whereHas('user.territory', function ($q) use ($value) {
                                $q->where('name', 'like', "%{$value}%");
                            });
                            break;
                        case 'cluster_name':
                            $query->whereHas('user.cluster', function ($q) use ($value) {
                                $q->where('name', 'like', "%{$value}%");
                            });
                            break;
                        case 'lat':
                            $query->where('clockins.lat', 'like', "%{$value}%");
                            break;
                        case 'long':
                            $query->where('clockins.long', 'like', "%{$value}%");
                            break;
                    }
                }
            }
        }

        // Apply independent date/time filters
        $dateFrom = !empty($this->filters['dateFrom']) ? Carbon::parse($this->filters['dateFrom'], 'Africa/Nairobi') : null;
        $dateTo = !empty($this->filters['dateTo']) ? Carbon::parse($this->filters['dateTo'], 'Africa/Nairobi') : null;
        $timeFrom = !empty($this->filters['timeFrom']) ? $this->filters['timeFrom'] : null;
        $timeTo = !empty($this->filters['timeTo']) ? $this->filters['timeTo'] : null;

        if ($dateFrom || $dateTo || $timeFrom || $timeTo) {
            // Initialize start and end times
            $startDateTime = null;
            $endDateTime = null;

            // Handle dateFrom (inclusive)
            if ($dateFrom) {
                $startDateTime = $timeFrom 
                    ? Carbon::parse($this->filters['dateFrom'] . ' ' . $timeFrom, 'Africa/Nairobi')
                    : $dateFrom->startOfDay();
            }

            // Handle dateTo
            if ($dateTo) {
                $endDateTime = $timeTo 
                    ? Carbon::parse($this->filters['dateTo'] . ' ' . $timeTo, 'Africa/Nairobi')
                    : $dateTo->endOfDay();
            }

            // Handle timeFrom or timeTo without dates
            if (!$dateFrom && $timeFrom) {
                // Apply timeFrom to today's date if no dateFrom
                $startDateTime = Carbon::today('Africa/Nairobi')->setTimeFromTimeString($timeFrom);
            }
            if (!$dateTo && $timeTo) {
                // Apply timeTo to today's date if no dateTo
                $endDateTime = Carbon::today('Africa/Nairobi')->setTimeFromTimeString($timeTo);
            }

            // Apply the filter
            if ($startDateTime && $endDateTime) {
                $query->whereBetween('clockins.created_at', [$startDateTime, $endDateTime]);
            } elseif ($startDateTime) {
                $query->where('clockins.created_at', '>=', $startDateTime);
            } elseif ($endDateTime) {
                $query->where('clockins.created_at', '<=', $endDateTime);
            }
        }

        Log::info('Export Query:', ['sql' => $query->toSql(), 'bindings' => $query->getBindings()]);

        return $query;
    }

    public function map($clockin): array
    {
        return [
            'id' => $clockin->id,
            'user_name' => $clockin->user->name ?? 'No User',
            'team_name' => $clockin->user->team->name ?? 'None',
            'region_name' => $clockin->user->region->name ?? 'None',
            'territory_name' => $clockin->user->territory->name ?? 'None',
            'cluster_name' => $clockin->user->cluster->name ?? 'None',
            'lat' => $clockin->lat,
            'long' => $clockin->long,
            'date' => date('d-M-Y', strtotime($clockin->created_at)),
            'time' => date('H:i', strtotime($clockin->created_at)),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'Team',
            'Region',
            'Territory',
            'Cluster',
            'Latitude',
            'Longitude',
            'Date',
            'Time'
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}