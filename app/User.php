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
        'firstname', 'lastname', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the incidents that the user has had
     */
    public function incidents()
    {
        return $this->hasMany('App\Incident');
    }

    /**
     * Get the contacts that are associated with the user
     */
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    /**
     * Get the potential threats associated with the user
     */
    public function threats()
    {
        return $this->hasMany('App\Threat');
    }
}
