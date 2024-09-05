<?php

namespace App\Models;

use App\Models\Scopes\DefaultTeamScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'organization_id'

    ];

    public function teamLead()
    {
        return $this->hasOne(User::class, 'team_id')->where('usertype', 'teamlead');
    }

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
        // static::addGlobalScope(new DefaultTeamScope);
        
    }

    public function organization(){
        return $this->belongsTo(Organization::class,'organization_id');
    }
    
}
