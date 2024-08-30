<?php

namespace App\Models;

use App\Models\Scopes\DefaultTeamScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clockout extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(User::class,'user_id');
    }
    // public function clockin(){
    //     //return $this->belongsTo(User::class);
    //     return $this->belongsTo(Clockin::class,'clockin_id');
    // }
    protected $fillable = [
        'user_id',
        'clockin_id',
        'time',
        'lat',
        'long',
        'organization_id',
        'team_id'

    ];
    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
        static::addGlobalScope(new DefaultTeamScope);
    }
}
