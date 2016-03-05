<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * Get the incident that the media belongs to
     */
    public function incident()
    {
        return $this->belongsTo('App\Incident');
    }
}
