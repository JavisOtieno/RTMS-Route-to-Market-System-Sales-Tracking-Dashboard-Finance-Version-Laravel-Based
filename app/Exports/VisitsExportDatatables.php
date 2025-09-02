<?php

namespace App\Exports;

use App\Models\Visit;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Log;

class VisitsExportDatatables implements FromQuery, WithHeadings, WithChunkReading, WithMapping
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
        Log::info('Export Filters Received:', $filters);
    }

    public function query()
    {
        $query = Visit::with(['user', 'user.team', 'user.region', 'user.territory', 'outlet'])
            ->select('visits.*')
            ->whereNull('visits.deleted_at'); // Handle soft deletes

        // Apply global search filter
        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('visits.id', 'like', "%{$search}%")
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
                            });
                    })
                    ->orWhereHas('outlet', function ($q) use ($search) {
                        $q->where('lat', 'like', "%{$search}%")
                         ->orWhere('contact_person_name', 'like', "%{$search}%")
                          ->orWhere('name', 'like', "%{$search}%")
                          ->orWhere('phone', 'like', "%{$search}%")
                          ->orWhere('long', 'like', "%{$search}%");
                    });
            });
        }

        // Apply column-specific filters
        if (!empty($this->filters['columns'])) {
            foreach ($this->filters['columns'] as $column => $value) {
                if ($value !== '' && $column !== 'actions') {
                    switch ($column) {
                        case 'id':
                            $query->where('visits.id', 'like', "%{$value}%");
                            break;
                        case 'outlet_name':
                            $query->whereHas('outlet', function ($q) use ($value) {
                                $q->where('name', 'like', "%{$value}%");
                            });
                            break;
                        case 'contactpersonname':
                            $query->whereHas('outlet', function ($q) use ($value) {
                                $q->where('contact_person_name', 'like', "%{$value}%");
                            });
                            break;
                        case 'phone':
                            $query->whereHas('outlet', function ($q) use ($value) {
                                $q->where('phone', 'like', "%{$value}%");
                            });
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
                        case 'lat':
                            $query->whereHas('outlet', function ($q) use ($value) {
                                $q->where('lat', 'like', "%{$value}%");
                            });
                            break;
                        case 'long':
                            $query->whereHas('outlet', function ($q) use ($value) {
                                $q->where('long', 'like', "%{$value}%");
                            });
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
                $query->whereBetween('visits.created_at', [$startDateTime, $endDateTime]);
            } elseif ($startDateTime) {
                $query->where('visits.created_at', '>=', $startDateTime);
            } elseif ($endDateTime) {
                $query->where('visits.created_at', '<=', $endDateTime);
            }
        }

        

        Log::info('Export Query:', ['sql' => $query->toSql(), 'bindings' => $query->getBindings()]);

        return $query;



            // parse inputs (in Africa/Nairobi timezone)
    $tz = 'Africa/Nairobi';
    $dateFrom = !empty($filters['dateFrom']) ? Carbon::parse($filters['dateFrom'], $tz) : null;
    $dateTo   = !empty($filters['dateTo'])   ? Carbon::parse($filters['dateTo'], $tz)   : null;
    $timeFrom = !empty($filters['timeFrom']) ? $filters['timeFrom'] : null;
    $timeTo   = !empty($filters['timeTo'])   ? $filters['timeTo'] : null;

    // Helper to convert local Carbon to UTC string for DB comparison
    $toUtcString = function (Carbon $c) {
        return $c->copy()->setTimezone('UTC')->toDateTimeString();
    };

    // 1) If a date range is provided (with or without times) => build datetimes and use where/whereBetween
    if ($dateFrom || $dateTo) {
        if ($dateFrom) {
            $start = $timeFrom
                ? Carbon::parse($dateFrom->toDateString() . ' ' . $timeFrom, $tz)
                : $dateFrom->copy()->startOfDay();
        }

        if ($dateTo) {
            $end = $timeTo
                ? Carbon::parse($dateTo->toDateString() . ' ' . $timeTo, $tz)
                : $dateTo->copy()->endOfDay();
        }

        if (isset($start) && isset($end)) {
            $query->whereBetween('visits.created_at', [
                $toUtcString($start),
                $toUtcString($end),
            ]);
        } elseif (isset($start)) {
            $query->where('visits.created_at', '>=', $toUtcString($start));
        } elseif (isset($end)) {
            $query->where('visits.created_at', '<=', $toUtcString($end));
        }

        return $query;
    }

    // 2) If only time filters are provided -> apply to TIME(visits.created_at) across all dates
    if ($timeFrom || $timeTo) {
        // Convert the time(s) from Nairobi -> UTC (so DB TIME() comparisons match local intent)
        // we use today's date as anchor to convert offsets
        $anchor = Carbon::today($tz)->toDateString();

        if ($timeFrom) {
            $timeFromUtc = Carbon::parse($anchor . ' ' . $timeFrom, $tz)
                ->setTimezone('UTC')
                ->format('H:i:s');
        } else {
            $timeFromUtc = null;
        }

        if ($timeTo) {
            $timeToUtc = Carbon::parse($anchor . ' ' . $timeTo, $tz)
                ->setTimezone('UTC')
                ->format('H:i:s');
        } else {
            $timeToUtc = null;
        }

        // If both times present
        if ($timeFromUtc && $timeToUtc) {
            if ($timeFromUtc <= $timeToUtc) {
                // simple between
                $query->whereRaw('TIME(visits.created_at) BETWEEN ? AND ?', [$timeFromUtc, $timeToUtc]);
            } else {
                // spans midnight (e.g. 22:00 -> 04:00) => TIME >= timeFrom OR TIME <= timeTo
                $query->where(function ($q) use ($timeFromUtc, $timeToUtc) {
                    $q->whereRaw('TIME(visits.created_at) >= ?', [$timeFromUtc])
                      ->orWhereRaw('TIME(visits.created_at) <= ?', [$timeToUtc]);
                });
            }

            return $query;
        }

        // single-sided time filters
        if ($timeFromUtc) {
            $query->whereRaw('TIME(visits.created_at) >= ?', [$timeFromUtc]);
        } elseif ($timeToUtc) {
            $query->whereRaw('TIME(visits.created_at) <= ?', [$timeToUtc]);
        }

        return $query;
    }

    // 3) nothing provided => no filtering on created_at
    return $query;
    }

    public function map($visit): array
    {

        // Format sales
        $salesString = 'None';
        if ($visit->sales && $visit->sales->count() > 0) {
            $salesItems = [];
            foreach ($visit->sales as $sale) {
                if ($sale->saleitems && $sale->saleitems->count() > 0) {
                    foreach ($sale->saleitems as $item) {
                        $productName = $item->product->name ?? 'Product';
                        $pieces = $item->pieces ?? 0;
                        $price = number_format($item->price ?? 0);
                        $value = number_format($item->value ?? 0);
                        $salesItems[] = "{$productName} - {$pieces} pcs @ KSh {$price} = KSh {$value}";
                    }
                } else {
                    $salesItems[] = 'Sale recorded (no items)';
                }
            }
            $salesString = implode("\n", $salesItems);
        }

        // Format followups
        $followupsString = 'None';
        if ($visit->followups && $visit->followups->count() > 0) {
            $followupsItems = [];
            foreach ($visit->followups as $followup) {
                $type = ucfirst($followup->type ?? 'Followup');
                $description = $followup->description ?? '';
                $status = !empty($followup->status) ? ucfirst($followup->status) : '';
                $followupsItems[] = "{$type}: {$description} {$status}";
            }
            $followupsString = implode("\n", $followupsItems);
        }

        // Format feedbacks
        $feedbacksString = 'None';
        if ($visit->feedbacks && $visit->feedbacks->count() > 0) {
            $feedbacksItems = [];
            foreach ($visit->feedbacks as $feedback) {
                $feedbacksItems[] = $feedback->feedback ?? '';
            }
            $feedbacksString = implode("\n", $feedbacksItems);
        }

        return [
            'id' => $visit->id,
            'user_name' => $visit->user->name ?? 'No User',
            'customer_name' => $visit->outlet->name ?? 'N/A',
            'contact_name' => $visit->outlet->contact_person_name ?? 'N/A',
            'phone' => $visit->outlet->phone ?? 'N/A',
            'team_name' => $visit->user->team->name ?? 'None',
            'region_name' => $visit->user->region->name ?? 'None',
            'territory_name' => $visit->user->territory->name ?? 'None',
            'lat' => $visit->outlet->lat ?? null,
            'long' => $visit->outlet->long ?? null,
            'date' => date('d-M-Y', strtotime($visit->created_at)),
            'time' => date('H:i', strtotime($visit->created_at)),
            'checkouttime' => date('H:i', strtotime($visit->checkouttimeexact)),
            'duration' => date('H:i:s', strtotime($visit->duration)),
            'sales' => $salesString,
            'followups' => $followupsString,
            'feedbacks' => $feedbacksString,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'Customer Name',
            'Contact Name',
            'Phone',
            'Team',
            'Region',
            'Territory',
            'Latitude',
            'Longitude',
            'Date',
            'Checkin Time',
            'Checkout Time',
            'Duration',
            'Sales',
            'Followups',
            'Feedback',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}