<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'auth.login' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        if ( $user->loginAttempt($request) ) {

        	session()->flash( 'success', 'Welcome back!' );

        	return redirect()->intended('/');

        } 

        session()->flash( 'error', 'Password was incorrect.' );

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
    	auth()->logout();

    	session()->regenerate();
    	
        return redirect( '/' );
    }
}
