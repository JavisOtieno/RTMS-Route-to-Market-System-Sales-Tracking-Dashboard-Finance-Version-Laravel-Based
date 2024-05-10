<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'contact_person_name',
        'phone',
        'lat',
        'long',
        'image'
    ];

    public function user(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(User::class,'user_id');
    }

    //meant for counting but found another way
    // public function sales()
    // {
    //     return $this->belongsToMany(Sale::class, 'outlets', 'outlet_id', 'id');
    // }
}
