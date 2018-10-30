<?php

namespace App;

use App\Base;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Support extends Base
{
    //// Set up and overides

    /**
    * Always eager load relationships
    *
    * @var array
    */
    protected $with = ['replies', 'replies.user'];
    
    /**
    * Add timestamps as Carbon Instaces
    *
    * @var array
    */
    protected $dates = ['user_deleted_at'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uid';
    }

	///// Relationships
	
    /**
    * Relationship to user model (author)
    */
    public function user()
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
    public function assigned()
    {
    	return $this->belongsTo( User::class, 'assigned_id', 'id' );
    }

    ///// Queries

     /**
    * Get a full list for admin pages 
    *
    * @param string $order
    * @param array $with
    * @return Collection
    */
    public function fullList()
    {
        $query = $this->with( 'user', 'assigned' )
                ->withCount( 'replies' )
                ->latest();

        // Check if user can view all or restricted to just assigned
        if ( ! auth()->user()->hasPerm('view-support') ) {

            $query = $query->where( 'assigned', auth()->id() );

        }

        return $query->get();
    }

    /**
    * Get a public listing of support requests
    *
    * @param int $id
    * @return Collection
    */
    public function publicList($id = null)
    {
        // if id is passed in, use it otherwise use auth user's id
        $id = $id?? auth()->id();

        return $this->with( 'replies' )
                ->where( 'user_id', $id )
                ->whereNull( 'user_deleted_at' )
                ->latest()
                ->get();
    }

    /**
    * Assign a support request to an admin
    *
    * @param \Illuminate\Http\Request $request
    * @return boolean
    */
    public function assign(Request $request)
    {
        $request->validate([
            'assigned_id' => 'required|numeric|exists:users,id',
        ]);

        return $this->update(['assigned_id' => $request->assigned_id]);
    }

    /**
    * Set a support as deleted
    *
    * @return boolean
    */
    public function delete()
    {
        // Set up and set variable to null
        $deleted_at = null;

        // if current value is null, we need to set varible to a timestamp
        if ( is_null($this->user_deleted_at) ) {

            $deleted_at = Carbon::now();

        } 

        // update current deleted at column
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
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'user_id' => auth()->id()?? null,
            'subject' => $request->subject,
            'message' => $request->message,
            'requires_reply' => $request->requires_reply?? false,
            'send_notification' => $request->send_notification?? true,
        ];

        if ( $request->isMethod('post') ) {

            $data['uid'] = str_random( 20 );

            if ( $this->where( 'uid', $data['uid'] )->count() > 0 ) {

                return $this->setData( $request );

            }
        }

        return $data;
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
