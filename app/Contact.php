<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * Get the users that the contact is associated with
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
