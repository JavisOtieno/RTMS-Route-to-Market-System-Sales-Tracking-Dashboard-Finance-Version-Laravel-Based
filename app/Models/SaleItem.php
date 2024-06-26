<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'sale_id',
        'product_id',
        'pieces',
        'price',
        'value',
        // 'organization_id'

    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    // protected static function booted()
    // {
    //     static::addGlobalScope(new OrganizationScope);
    // }
}
