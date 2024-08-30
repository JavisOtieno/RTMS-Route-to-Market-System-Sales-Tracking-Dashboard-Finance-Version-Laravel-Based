<?php

namespace App\Models;

use App\Models\Scopes\DefaultTeamScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Territory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'region_id',
        'organization_id'

    ];

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
        // static::addGlobalScope(new DefaultTeamScope);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

}
