<?php

namespace App\Models;

use App\Models\Scopes\DefaultTeamScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'outlet_id',
        'clockin_id',
        'checkin_time',
        'checkin_latitude',
        'checkin_longitude',
        'checkout_time',
        'checkout_latitude',
        'checkout_longitude',
        'duration',
        'organization_id',
        'team_id'

    ];

    public function user(){
        //return $this->belongsTo(User::class);
        return $this->belongsTo(User::class,'user_id');
    }
    public function outlet(){
        return $this->belongsTo(Outlet::class,'outlet_id');
    }
    public function clockin()
    {
        return $this->belongsTo(Clockin::class);
    }
    public function team(){
        return $this->belongsTo(Team::class,'team_id');
    }
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
    public function competitors()
    {
        return $this->hasMany(Competitor::class);
    }
    public function posaudits()
    {
        return $this->hasMany(Posaudit::class);
    }
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
    public function followups()
    {
        return $this->hasMany(Followup::class);
    }
    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
        static::addGlobalScope(new DefaultTeamScope);
    }
}
