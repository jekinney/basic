<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    ///// Setup and overides

    protected $with = ['role'];

    /**
     * Guarded columns that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    ///// Relationships

    /**
    * Get the user's role
    */
    public function role()
    {
        return $this->belongsTo( Role::class );
    }

    /**
    * Get the user's permissions
    */
    public function permissions()
    {
        if ( !$this->role ) {

            return null;

        }

        return $this->role->permissions;
    }

    /**
    * Check if user object has a role and
    * applicable permission
    * 
    * @param string $slug
    * @return boolean
    */
    public function hasPerm($slug)
    {
        if ( $this->role_id > 0 && $this->permissions()->contains( 'slug', $slug) ) {

            return true;

        }

        return false;
    }

    ///// Queries

    /**
    * Attempt to login a user to the system
    * 
    * @param \Illuminate\Http\Request $request
    * @return boolean;
    */
    public function loginAttempt(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
            'remember' => 'boolean',
        ]);

        if ( auth()->attempt($request->only( 'email', 'password' ), $request->has( 'remember' )) ) {

            return true;

        }

        return false;
    }

    /** 
    * Store a new user (register)
    *
    * @param \Illuminate\Http\Request $request
    * @return boolean;
    */
    public function store(Request $request)
    {
        $rules = [
            'name' => $this->nameRules( true ),
            'email' => $this->emailRules( true ),
            'password' => $this->passwordRules(),
        ];

        $request->validate( $rules );

        return $this->create([ 
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt( $request->password ),
        ]);
    }

    ///// Helpers

    /**
    * Set rules for name
    *
    * @param boolean $isNotPost
    * @return string
    */
    private function nameRules($isNotPost)
    {
        $rule = 'required|max:60|string|unique:users,name';

        if ( !$isNotPost ) {

            $rule .= ','. auth()->id();

        }  

        return $rule; 
    }

    /**
    * Set rules for email
    *
    * @param boolean $isNotPost
    * @return string
    */
    private function emailRules($isNotPost)
    {
        $rule = 'required|email|unique:users,email';

        if ( !$isNotPost ) {

            $rule .= ','. auth()->id();

        }   

        return $rule;
    }

    /**
    * Set rules for password
    *
    * @return string
    */
    private function passwordRules()
    {
        return 'required|between:5,20|confirmed|string'; 
    }
}
