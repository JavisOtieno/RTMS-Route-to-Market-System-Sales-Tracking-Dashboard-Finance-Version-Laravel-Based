<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RouteplanItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'routeplan_id',
        'outlet_id',
        'visit_id'
    ];

    public function routeplan()
    {
        return $this->belongsTo(Routeplan::class);
    }
    public function outlet(){
        return $this->belongsTo(Outlet::class,'outlet_id');
    }
}
