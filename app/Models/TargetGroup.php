<?php

namespace App\Models;

use App\Models\Scopes\DefaultTeamScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\TeamScopeWithNullObjects;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TargetGroup extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'amount',
        'organization_id',
        'team_id'

    ];
    
    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
        static::addGlobalScope(new TeamScopeWithNullObjects);
    }

    
}
