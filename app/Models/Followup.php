<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'outlet_id',
        'visit_id',
        'type',
        'description',
        'status',
        'organization_id',
        'team_id',
        'date',
        'time'
    ];


}
