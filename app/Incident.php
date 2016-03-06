<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator;

class Incident extends Model
{
    /**
     * Get the user that reported the incident
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Creates an alert to the incident reports
     */
    public function sendIncident(Request $request)
    {
      return true;
    }
}
