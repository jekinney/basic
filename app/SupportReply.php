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
            'user_id' => auth()->id()?? null,
            'message' => $request->message,
            'support_id' => $request->support_id,
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
        return $request->validate([
            'message' => 'required|string',
            'support_id' => 'required|numeric|exists:supports,id',
        ]);
    }
}
