<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
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

            $rules['name'] .= ','. $request->id;

        }

        return $request->validate( $rules );
    }
}
