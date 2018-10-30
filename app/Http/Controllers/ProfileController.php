<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $users = $user->paginatedList( 20 );

        return view( 'profile.index', compact('users') );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user;
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        return view ('profile.show', compact('user') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user()->editProfile();

        return view ('profile.edit', compact('user') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateName(Request $request, User $user)
    {
        $user->updateName( $request );

        session()->flash( 'success', 'Your name has been updated.' );

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateEmail(Request $request, User $user)
    {
        $user->updateEmail( $request );

        session()->flash( 'success', 'Your email has been updated.' );

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user)
    {
        $user->updatePassword( $request );

        session()->flash( 'success', 'Your password has been updated.' );

        return back();
    }
}
