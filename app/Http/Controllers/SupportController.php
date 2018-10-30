<?php

namespace App\Http\Controllers;

use App\User;
use App\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Support $support)
    {
        $support = $support->publicList();

        return view( 'support.index', compact('support') );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin(Support $support, User $user)
    {   
        $admins = $user->supportAdmins();
        $support = $support->fullList();

        return view( 'dash.support.index', compact('admins', 'support') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'support.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Support $support)
    {
        $support = $support->store( $request );

        session()->flash( 'success', 'Support request has been created and admins notified. Please allow a few hours for a response.' );

        return redirect()->route( 'support.show', $support );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Support $support
     * @return \Illuminate\Http\Response
     */
    public function show(Support $support)
    {
        $support = $support->single( ['assigned', 'replies', 'replies.user'] );

        return view( 'support.show', compact('support') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Support $support
     * @return \Illuminate\Http\Response
     */
    public function edit(Support $support, User $user)
    {
        $admins = $user->supportAdmins();
        $support = $support->single( ['replies', 'replies.user'] );

        return view( 'dash.support.edit', compact('admins', 'support') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Support $support
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Support $support)
    {
        $support = $support->assign( $request );

        session()->flash( 'success', 'Support Request has been assigned.' );

        return redirect()->route( 'dash.support.index' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Support $support
     * @return \Illuminate\Http\Response
     */
    public function destroy(Support $support)
    {
        if ( $support->remove() ) {

            session()->flash( 'success', 'Support request has been removed.' );

        } else {

            session()->flash( 'error', 'Unable to remove support request at this time.' );

        }

        return back();
    }
}
