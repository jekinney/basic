<?php

namespace App\Blog;

use App\Base;
use Illuminate\Http\Request;

class Category extends Base
{
	/**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
    * Relationship to article model
    */
    public function articles()
    {
    	return $this->hasMany( Article::class );
    }

    ///// Queries

    /**
    * Get full list of categories for admin
    *
    * @return Collection
    */
    public function fullList()
    {
        return $this->withCount( 'articles' )
                ->orderBy( 'name', 'asc' )
                ->paginate( 20 );
    }

    /**
    * Get published and\or public data
    *
    * @return Collection
    */
    public function publishedList()
    {
        return $this->withCount( 'articles' )
                ->orderBy( 'name', 'asc' )
                ->paginate( 20 );
    }

    /**
    * Get for showing
    *
    * @return Model
    */
    public function show()
    {
        return $this->load( 'articles' );
    }

    /**
    * Get for editing
    *
    * @return Model
    */
    public function edit()
    {
        return $this;
    }

    public function remove()
    {
        if ( $this->articles->count() > 0 ) {

            return false;

        }

        return $this->delete();
    }

    ///// Helpers

    /**
    * Set data for inserting into database
    *
    * @param \Illuminate\Http\Request $request
    * @return array
    */
    protected function setData(Request $request)
    {
    	return [
    		'name' => $request->name,
    		'slug' => str_slug( $request->name ),
    	];
    }

    /**
    * Validate incoming input data
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Request
    */
    protected function validateInput(Request $request)
    {
    	$rules = [
    		'name' => 'required|string|unique:categories,name',
    	];

    	if ( ! $request->isMethod('post') ) {

    		$rules['name'] .= ','. $this->id;

    	}	

    	return $request->validate( $rules );
    }
}
