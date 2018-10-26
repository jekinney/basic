<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $users = $user->fullList();

        return view( 'dash.user.index', compact('users') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Role $role)
    {
        $roles = $role->selectList( 'name', ['name'] );

        return view( 'dash.user.edit', compact('user', 'roles') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = $user->renew( $request );

        session()->flash( 'success', 'User has been updated.' );

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function ban(User $user)
    {
        if ( $user->toggleBan() ) {

            if ( is_null($user->banned_at) ) {

                session()->flash( 'success', 'User ban has been lifted.' );

            } else {

                session()->flash( 'warning', 'User has been banned.' );

            }

        } else {

            session()->flash( 'info', 'You can not ban yourself.' );

        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->remove();

        session()->flash( 'success', 'User has been removed.' );

        return back();
    }
}
