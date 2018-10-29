<?php

namespace App;

use App\Base;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Support extends Base
{
    /**
    * Add timestamps as Carbon Instaces
    *
    * @var array
    */
    protected $dates = ['user_deleted_at'];

	///// Relationships
	
    /**
    * Relationship to user model (author)
    */
    protected function user()
    {
    	return $this->belongsTo( User::class );
    }

    /**
    * Relationship to support reply model
    */
    public function replies()
    {
    	return $this->hasMany( SupportReply::class )->latest();
    }

    /**
    * Relationship to user model for admin assigned
    */
    protected function assigned()
    {
    	return $this->belongsTo( User::class, 'assigned_id', 'id' );
    }

     /**
    * Get a full list for admin pages 
    *
    * @param string $order
    * @param array $with
    * @return Collection
    */
    public function fullList()
    {
        if ( auth()->user()->hasPerm('view-support') ) {

            return $this->with( 'user', 'assigned' )
                ->withCount( 'replies' )
                ->latest()
                ->get();

        }

        return $this->with( 'user', 'assigned' )
                ->withCount( 'replies' )
                ->where( 'assigned', auth()->id() )
                ->latest()
                ->get();
    }

    public function publicList($id = null)
    {
        $id = $id?? auth()->id();

        return $this->with( 'replies' )
                ->where( 'user_id', $id )
                ->whereNull( 'user_deleted_at' )
                ->latest()
                ->get();
    }

    public function delete()
    {
        $deleted_at = null;

        if ( is_null($this->user_deleted_at) ) {

            $deleted_at = Carbon::now();

        } 

        return $this->update(['user_deleted_at' => $deleted_at]);
    }

    ///// Helpers

    /**
    * Set data for db insert
    *
    * @param \Illuminate\Http\Request $request
    * @return array
    */
    protected function setData(Request $request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'user_id' => auth()->id()?? null,
            'subject' => $request->subject,
            'message' => $request->message,
            'requires_reply' => $request->requires_reply?? false,
        ];
    }

    /**
    * Validate input data
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Request
    */
    protected function validateInput(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:120',
            'email' => 'required|email',
            'subject' => 'required|string|max:120',
            'message' => 'required|string',
            'requires_reply' => 'boolean',
        ];

        return $request->validate( $rules );
    }
}
