<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vk_id', 'first_name', 'last_name', 'avatar_url', 'name', 'email',
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
