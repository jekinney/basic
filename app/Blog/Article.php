<?php

namespace App\Blog;

use App\Base;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Article extends Base
{
    /**
    * Always eager load relationship
    *
    * @var array
    */
    protected $with = ['author', 'category'];

    /**
    * Add attributes as Carbon instances
    *
    * @var array
    */
    protected $dates = ['publish_at'];

	/**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

	public function author()
	{
		return $this->belongsTo( User::class, 'user_id', 'id' )->select('id', 'name');
	}

    public function category()
    {
    	return $this->belongsTo( Category::class );
    }

    ///// Queries

    /**
    * Get full list of categories for admin
    *
    * @return Collection
    */
    public function fullList()
    {
        return $this->orderBy( 'publish_at', 'desc' )
                ->paginate( 20 );
    }


    /**
    * Get published and\or public data
    *
    * @return Collection
    */
    public function publishedList()
    {
        return $this->whereNotNull( 'publish_at' )
                ->where( 'publish_at', '<', Carbon::now() )
                ->orderBy( 'publish_at', 'desc' )
                ->paginate( 20 );
    }

    /**
    * Get for showing
    *
    * @return Model
    */
    public function show()
    {
        return $this;
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


    ///// Helpers

    protected function setData(Request $request)
    {
    	return [
    		'slug' => str_slug( $request->title ),
    		'title' => $request->title,
    		'user_id' => $request->user_id?? auth()->id(),
    		'content' => $request->content,
    		'description' => $request->description?? str_limit( $request->content, 550 ),
    	];
    }

    protected function validateInput(Request $request)
    {
    	$rules = [
    		'title' => 'required|string|unique:articles,title',
    		'content' => 'required',
    		'user_id' => 'numeric|exists:users,id',
    		'category_id' => 'required|numeric|exists:categories,id',
    		'description' => 'string|max:550',
    	];

    	if ( ! $request->isMethod('post') ) {

    		$rules['title'] .= ','. $this->id;

    	}	

    	return $request->validate( $rules );
    }
}
