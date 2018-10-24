<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    ///// Setup and overides

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
        return $this->hasManyThrough( Permission::class, Role::class );
    }

    ///// Helpers

    /**
    * Check if user has a role
    *
    * @param string $slug
    * @return boolean
    */
    public function hasRole($slug)
    {
        return $this->role->slug === $slug;
    }

    /**
    * Check if user has permission(s)
    *
    * @param string $slug
    * @return boolean
    */
    public function hasPermission($permissions, $requireAll = false)
    {

    }
}
