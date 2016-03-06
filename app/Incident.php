<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator;
use Uuid;
use Auth;

class Incident extends Model
{
    /**
     * Validation rules for a user
     */
    private $rules = array(
        'location' => 'required'
    );

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
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return false;
        } else {
            $user = Auth::guard('api')->user();
            $this->location = $request->location;
            $this->uuid = Uuid::generate(4);
            $this->user_id = $user->id;
            $this->resolved = false;
            $saved = $this->save();

            return $saved;
        }
    }

    /**
     * Mark an incident as resolved
     */
    public function markIncident(Request $request)
    {
        $this->resolved = true;
        $saved = $this->save();

        return $saved;
    }

    /**
     * Returns a JSON representation of the USER object
     */
    public function getJSON()
    {
        $user = User::find($this->user_id);

        return [
            'uuid' => $this->uuid,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone' => $user->phone,
            'location' => $this->location,
            'resolved' => $this->resolved,
            'created_at' => $this->created_at->format('d/m/Y h:i:s A'),
        ];
    }
}
