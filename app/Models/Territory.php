<?php

namespace App\Models;

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
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

}
