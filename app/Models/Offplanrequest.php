<?php

namespace App\Models;

use App\Models\Scopes\DefaultTeamScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offplanrequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'routeplan_id',
        'visit_id',
        'status',
        'organization_id',
        'team_id'
    ];

    public function team(){
        return $this->belongsTo(Team::class,'team_id');
    }
    public function routeplan(){
        return $this->belongsTo(Routeplan::class,'routeplan_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    
    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
        static::addGlobalScope(new DefaultTeamScope);
    }
    
}
