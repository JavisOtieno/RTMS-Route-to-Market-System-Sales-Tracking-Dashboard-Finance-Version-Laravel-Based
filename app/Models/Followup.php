<?php

namespace App\Models;

use App\Models\Scopes\DefaultTeamScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function user(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(User::class,'user_id');
    }

    public function team(){
        return $this->belongsTo(Team::class,'team_id');
    }

    //meant for counting but found another way
    // public function sales()
    // {
    //     return $this->belongsToMany(Sale::class, 'outlets', 'outlet_id', 'id');
    // }

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
        static::addGlobalScope(new DefaultTeamScope);
    }


}
