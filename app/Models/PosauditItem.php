<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosauditItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'posaudit_id',
        'product_id',
        'pieces'

    ];

    public function posaudit()
    {
        return $this->belongsTo(Posaudit::class);
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
