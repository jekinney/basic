<?php

namespace App;

use App\Base;
use Illuminate\Http\Request;

class Permission extends Base
{
    ///// Setup and overides

    /**
     * Guarded columns that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    ///// Relationships

    /**
    * Get the user assigned to a role
    */
    public function roles()
    {
        return $this->belongsToMany( Role::class );
    }

    ///// Helpers

    /**
    * Get a full permissions list for admins
    *
    * @return Collection
    */
    public function fullList()
    {
        return $this->get();
    }

    /**
    * set up request data to insert into database.
    *
    * @param \Illuminate\Http\Request $request
    * @return array
    */
    protected function setData(Request $request)
    {
        
    }

    /**
    * Validate input data as needed. 
    *
    * @param \Illuminate\Http\Request $request
    * @return Model
    */
    protected function validateInput(Request $request)
    {
        
    }
}
