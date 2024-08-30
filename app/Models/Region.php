<?php

namespace App\Models;

use App\Models\Scopes\DefaultTeamScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'organization_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
        // static::addGlobalScope(new DefaultTeamScope);
    }

    public function territories()
    {
        return $this->hasMany(Territory::class);
    }
}
