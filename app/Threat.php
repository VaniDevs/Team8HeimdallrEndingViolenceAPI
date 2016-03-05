<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Threat extends Model
{
    /**
     * Get the users that the suspected threat is associated with
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
