<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posaudit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'outlet_id',
        'visit_id'

    ];
    public function user(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(User::class,'user_id');
    }
    public function outlet(){
        return $this->belongsTo(Outlet::class,'outlet_id');
    }
    public function visit(){
        return $this->belongsTo(Visit::class,'visit_id');
    }
    public function posaudititems()
    {
        return $this->hasMany(PosauditItem::class);
    }
}
