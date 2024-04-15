<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clockout extends Model
{
    use HasFactory;

    public function user(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(User::class,'user_id');
    }
    protected $fillable = [
        'user_id',
        'time',
        'lat',
        'long',

    ];
}
