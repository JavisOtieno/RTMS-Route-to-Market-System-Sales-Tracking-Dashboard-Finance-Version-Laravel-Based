<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'registration_number',
        'kra_pin',
        'status'
    ];

    public function admin()
    {
        return $this->hasOne(User::class, 'organization_id')->where('usertype', 'admin');
    }
    
}
