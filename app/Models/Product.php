<?php

namespace App\Models;

use App\Models\Scopes\DefaultTeamScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'producttype',
        'targettype',
        'target',
        'sku',
        'organization_id'

    ];
    
    public function saleitems()
    {
        return $this->hasMany(SaleItem::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
        static::addGlobalScope(new DefaultTeamScope);
    }
}
