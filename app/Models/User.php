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


// Results in error 500 because the scope requires the user class on Auth::user
    // protected static function booted()
    // {
    //     static::addGlobalScope(new OrganizationScope);
    // }

    public function scopeInOrganization($query)
    {
        $user = auth()->user();
        return $query->where('organization_id', $user->organization_id);
    }

    
}
