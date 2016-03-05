<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    /**
     * Get the user that reported the incident
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
