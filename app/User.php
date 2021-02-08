<?php

namespace Brainr;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
     * The relation to the collections that the user owns.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function collections()
    {
        return $this->morphMany(Collection::class, 'owner');
    }

    /**
     * Profiles owned by a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function profiles()
    {
        return $this->morphMany(Profile::class, 'owner');
    }
}
