<?php

namespace App;

use App\Base;
use Illuminate\Http\Request;

class SupportReply extends Base
{
    public function user()
    {
    	return $this->belongsTo( User::class );
    }

    public function support()
    {
    	return $this->belongsTo( Support::class );
    }

    ///// Queries

    public function fullList()
    {
    	return $this->get();
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
