<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'outlet_id',
        'product_id',
        'pieces',
        'checkin_time',
        'checkin_latitude',
        'checkin_longitude',
        'checkout_time',
        'checkout_latitude',
        'checkout_longitude',
        'duration'

    ];

    public function user(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(User::class,'user_id');
    }
    public function outlet(){
        return $this->belongsTo(Outlet::class,'outlet_id');
    }
}
