<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PosauditItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'posaudit_id',
        'product_id',
        'pieces',
        // 'organization_id'

    ];

    public function posaudit()
    {
        return $this->belongsTo(Posaudit::class);
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    // protected static function booted()
    // {
    //     static::addGlobalScope(new OrganizationScope);
    // }
}
