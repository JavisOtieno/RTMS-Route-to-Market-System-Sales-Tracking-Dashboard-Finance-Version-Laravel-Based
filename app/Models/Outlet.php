<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Outlet extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'contact_person_name',
        'phone',
        'lat',
        'long',
        'image',
        'organization_id'
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

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }
}
