<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Routeplan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'date',
        'organization_id'

    ];
    public function user(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(User::class,'user_id');
    }
  
    public function routeplanitems()
    {
        return $this->hasMany(RouteplanItem::class);
    }
    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }
}
