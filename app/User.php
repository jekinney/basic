<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    ///// Setup and overides

    /**
    * Alwasy eager load the relationship(s)
    *
    * @var array
    */
    protected $with = ['role'];

    /**
    * Add columns as Carbon instances
    *
    * @var array
    */
    protected $dates = ['banned_at'];

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

    public function bannedBy()
    {
        return $this->belongsTo( User::class, 'banned_by', 'id' );
    }


    ///// Queries

    public function fullList($amount = 20)
    {
        return $this->with( 'role.permissions' )
                ->orderBy( 'name', 'desc' )
                ->paginate( $amount );
    }

    public function publicList($amount = 20)
    {
        return $this->whereNotNull( 'banned_at' )
                ->orderBy( 'name', 'desc' )
                ->paginate( $amount );
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
            'name' => $this->nameRules( false ),
            'email' => $this->emailRules( false ),
            'password' => $this->passwordRules(),
        ];

        $request->validate( $rules );

        return $this->create([ 
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt( $request->password ),
        ]);
    }

    public function renew(Request $request)
    {
        $rules = [
            'name' => $this->nameRules( true ),
            'role_id' => 'required|numeric',
        ];

        $request->validate( $rules );

        $this->update([
            'name' => $request->name,
            'role_id' => $request->role_id,
        ]);

        return $this->fresh();
    }

    /**
    * Get all users with access to support
    */
    public function supportAdmins()
    {
        $admins = $this->has( 'role' )->get()->map( function( $user ) {
            if ( $user->hasPerm('view-support') ) {
                return $user;
            }
        });

        return $admins;           
    }

    public function editProfile()
    {
        return (object) $this->only(['name', 'email']);
    }

    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60|string',
        ]);

        return auth()->user()->update(['name' => $request->name]);
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,'. auth()->id(),
        ]);

        return auth()->user()->update(['email' => $request->email]);
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        if ( password_verify($request->current_password, $user->password) ) {

            $request->validate([
                'password' => 'required|between:6,20|string|confirmed',
            ]);

            return $user->update( ['password' => bcrypt($request->password)] );
        }

        session()->flash( 'danger', 'Current password is not correct.' );

        return back();
    }

    /**
    * Attempt to ban a user
    *
    * @return boolean
    */
    public function toggleBan()
    {
        // Can't ban your self
        if ( $this->id === auth()->id() ) {

            return false;

        }

        // check to see if we need to ban or un-ban
        if ( $this->banned_at ) {

            $banned = [
                'banned_at' => Carbon::now(),
                'banned_by' => auth()->id(),
            ];

        } else {

            $banned = [
                'banned_at' => null,
                'banned_by' => null,
            ];

        }

        // Update user
        $this->update( $banned );

        // return true
        return true;
    }

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

            if ( !auth()->user()->banned_at ) {

                return true;

            } else {

                auth()->logout();

                session()->regenerate();

                session()->flash( 'danger', 'Your account has been banned.' );
                
            }
            
        }

        return false;
    }

    ///// Helpers

    public function status()
    {
        if ( $this->banned_at ) {

            return (object) ['class' => 'alert alert-danger text-center', 'text' => 'Banned'];

        }

        return (object) ['class' => 'alert alert-success text-center', 'text' => 'Good'];
    }

    /**
    * Check if user object has a role
    * 
    * @return boolean
    */
    public function hasRole()
    {
        if ( $this->role_id > 0 ) {

            return true;

        }

        return false;
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
        if ( $this->role_id > 0 && $this->permissions()->contains('slug', $slug) ) {

            return true;

        }

        return false;
    }

    /**
    * Set rules for name
    *
    * @param boolean $isNotPost
    * @return string
    */
    private function nameRules($isNotPost)
    {
        $rule = 'required|max:60|string|unique:users,name';

        if ( $isNotPost ) {

            $rule .= ','. $this->id;

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
