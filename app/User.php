<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * Eloquest relationship linking users to contacts
     *
     *  @return Eloquesnt relationship
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function getAvatar()
    {
        return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?s=140";
    }
}
