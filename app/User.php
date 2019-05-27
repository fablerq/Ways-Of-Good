<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Place;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Organization;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function ticket()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    protected $fillable = [
        'name', 'email', 'password', 'vk_id', 'first_name',
    
        'avatar_url', 'last_name', 'image', 'points'
     ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'password',
    ];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Create confirmation key for user
     */
    public function boot()
    {
        parent::boot();

        static::creating(function ($user){
            $user -> token = random_int(30,40);
        });
    }

    /**
     * Hash user password
     */
    public function setPasswordAttribute($password)
    {
        $this -> attributes['password'] = bcrypt($password);
    }

    /**
     * Remove key from base
     */
    public function confirmEmail()
    {
        $this -> verified = true;
        $this -> token = null;

        $this -> save();
    }
}
