<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Organization;
use App\Models\Place;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function ticket()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function places()
    {
        return $this->belongsToMany(Place::class);
    }

    public function place()
    {
        return $this->hasMany('App\Models\Place');
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
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
