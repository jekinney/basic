<?php

namespace App\Http\Controllers;

use App\SupportReply;
use Illuminate\Http\Request;

class SupportReplyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SupportReply $reply)
    {
        $reply->store( $request );

        session()->flash( 'success' ,'Reply has been saved.' );

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SupportReply  $supportReply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupportReply $supportReply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SupportReply  $supportReply
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupportReply $supportReply)
    {
        //
    }
}
