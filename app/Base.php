<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

abstract class Base extends Model
{
	  ///// Setup and overides

    /**
     * Guarded columns that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    ///// Queries

    /**
    * Get a full list for admin pages 
    *
    * @param string $order
    * @param array $with
    * @return Collection
    */
    abstract public function fullList();

    /**
    *
    * @param string $order
    * @param array $columns
    * @return Collection
    */
    public function selectList($order, array $columns)
    {
    	   // Awlays add id for select
    	   $columns[] = 'id';

    	   return $this->orderBy( $order, 'asc' )->get( $columns );
    }

    /**
    * Get data to show a single item, 
    * assume route model binding
    *
    * @param array $with
    * @return Model
    */
    public function single(array $with = [])
    {
    	if ( empty($with) ) {

    		return $this;
    	}

    	return $this->load( $with );
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

  		return $this;
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

  		return $this->create( $this->setData($request) );
  	}


  	///// Helpers

  	/**
    * set up request data to insert into database.
    *
    * @param \Illuminate\Http\Request $request
    * @return array
    */
  	abstract protected function setData(Request $request);

  	/**
    * Validate input data as needed. 
    *
    * @param \Illuminate\Http\Request $request
    * @return Model
    */
  	abstract protected function validateInput(Request $request);
}
