<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Clockin;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClockinsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Clockin::all();
    // }
    public function collection()
    {
        return Clockin::with('user') // Ensure user relationship is loaded
        ->whereDate('created_at', Carbon::yesterday()) // Get only yesterday's records
            ->get()
            ->map(function ($clockin) {
                return [
                    'id'         => $clockin->id,
                    'user_name'  => $clockin->user->name ?? 'N/A', // Handle potential null values
                    'region'  => $clockin['user']['region']?$clockin['user']['region']['name']:'None',
                    'territory'  => $clockin['user']['territory']?$clockin['user']['territory']['name']:'None',
                    'cluster'  => $clockin['user']['cluster']?$clockin['user']['cluster']['name']:'None',
                    'lat'   => $clockin->lat,
                    'long'   => $clockin->long,
                    'date'  => date('d-M-Y', strtotime($clockin['created_at'])),
                    'time'  => date('H:i', strtotime($clockin['created_at']))
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'Region',
            'Territory',
            'Cluster',
            'Latitude',
            'Longitude',
            'Date',
            'Time'
        ];
    }
}
