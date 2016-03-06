<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Validator;

class User extends Authenticatable
{
    /**
     * Validation rules for a user
     */
    private $rules = array(
        'first_name' => 'min:2|max:25',
        'last_name' => 'min:2|max:25',
        'email' => 'email|unique',
        'address' => 'max:255|alpha',
        'photo' => 'max:255',
        'password' => 'password',
        'phone' => 'regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/'
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'address', 'password', 'phone'
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

    /**
     * Validates a requst to update the users profile information
     */
    public function updateInfo(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return false;
        } else {
            if ($request->has('first_name')) {
                $this->first_name = $request->first_name;
            }
            if ($request->has('last_name')) {
                $this->last_name = $request->last_name;
            }
            if ($request->has('address')) {
                $this->address = $request->address;
            }
            if ($request->has('phone')) {
                $this->phone = $request->phone;
            }
            $this->save();

            return true;
        }

        return false;
    }
}
