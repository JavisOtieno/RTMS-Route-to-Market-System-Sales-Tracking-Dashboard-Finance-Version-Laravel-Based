<?php

namespace App\Models;

use App\Models\Scopes\DefaultTeamScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clockin extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(User::class,'user_id');
    }

    protected $fillable = [
        'user_id',
        'time',
        'lat',
        'long',
        'organization_id'

    ];
    

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
    public function clockout()
    {
        return $this->hasOne(Clockout::class);
    }

        protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
        static::addGlobalScope(new DefaultTeamScope);
    }
}
