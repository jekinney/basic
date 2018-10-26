<?php

namespace App;

use App\Base;
use Illuminate\Http\Request;

class Role extends Base
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
    public function users()
    {
        return $this->hasMany( User::class );
    }

    /**
    * Get the permissions attached to a role
    */
    public function permissions()
    {
        return $this->belongsToMany( Permission::class );
    }

    ///// Helpers

    public function fullList()
    {
          return $this->withCount('users')
              ->with( 'users', 'permissions' )
              ->orderBy( 'name', 'desc' )
              ->get();
    }

    /**
    * Create and insert data a new model, 
    *
    * @param \Illuminate\Http\Request $request
    * @return Model
    */
    public function store(Request $request)
    {
        $this->validateInput( $request );

        $role = $this->create( $this->setData($request) );

        $role->permissions()->attach( $request->permissions );

        return $role;
    }

    /**
    * Update and insert data on a existing model, 
    *
    * @param \Illuminate\Http\Request $request
    * @return Model
    */
    public function renew(Request $request)
    {
        $this->validateInput( $request );

        $this->update( $this->setData($request) );

        $this->permissions()->sync( $request->permissions );

        return $this;
    }

    /**
    * Attempt to remove a role
    *
    * @return boolean
    */
    public function remove()
    {
        if ( $this->users->count() > 0 ) {

            return false;

        }

        $this->permissions()->detach();

        return $this->delete();
    }

    /**
    * set up request data to insert into database.
    *
    * @param \Illuminate\Http\Request $request
    * @return array
    */
  	protected function setData(Request $request)
  	{
    		return [
      			'name' => $request->name,
      			'slug' => str_slug( $request->name ),
      			'description' => $request->description,
    		];
  	}

  	/**
    * Validate input data as needed. 
    *
    * @param \Illuminate\Http\Request $request
    * @return Model
    */
  	protected function validateInput(Request $request)
  	{
    		$rules = [
      			'id' => 'numeric|exists:roles,id',
      			'name' => 'required|max:30|string|unique:roles,name',
      			'description' => 'required|max:255|string',
    		];

  		  if ( !$request->isMethod('post') ) {

  			    $rules['name'] .= ','. $this->id;

  		  }

  		  return $request->validate( $rules );
  	}
}
