<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'target_group_id',
        'region_id',
        'territory_id',
        'usertype',
        'email',
        'password',
        'organization_id',
        'team_id',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
//meant for counting but found another way
    // public function sales()
    // {
    //     return $this->belongsToMany(Sale::class, 'users', 'id', 'user_id');
    // }
    public function targetgroup(){
        return $this->belongsTo(TargetGroup::class,'target_group_id');
    }

    public function team(){
        return $this->belongsTo(Team::class,'team_id');
    }

    public function region(){
        return $this->belongsTo(Region::class,'region_id');
    }

    public function territory(){
        return $this->belongsTo(Territory::class,'territory_id');
    }

    public function organization(){
        return $this->belongsTo(Organization::class,'organization_id');
    }

// Results in error 500 because the scope requires the user class on Auth::user
    // protected static function booted()
    // {
    //     static::addGlobalScope(new OrganizationScope);
    // }

    public function scopeInOrganization($query)
    {
        $user = auth()->user();
        
        if($user->usertype=="admin" ){
        return $query->where('organization_id', $user->organization_id);
        }
        //limit users access to teamleads for now
        //combined with route limited access to urls
        //along with menu limitations 
        else if($user->usertype=="teamlead"){
        return $query->where('team_id', $user->team_id)->whereNotNull('team_id');
        }
        else if($user->usertype=="seller"){
        //allow current testers access
        //IDEAL
        // return $query->where('team_id', $user->team_id);
        //IDEAL

        return $query->where('team_id', $user->team_id)->orWhereNull('team_id');
        }

        else{
        // can be seller
        // Restrict access completely
        // return $query->whereRaw('1 = 0');
        }
        

    }

    
}
