<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Role $role)
    {
        $roles = $role->fullList();

        return view( 'dash.role.index', compact('roles') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Permission $permission)
    {
        $permissions = $permission->selectList(['id', 'name']);

        return view( 'dash.role.create', compact('permissions') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = $role->store( $request );

        session()->flash( 'success', 'Role has been created.' );

        return redirect()->route( 'role.index' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role = $role->single( ['permissions'] );

        return view( 'dash.role.show', compact('role') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role, Permission $permission)
    {
        $role = $role->single( ['permissions'] );

        $permissions = $permission->selectList(['id', 'name']);

        return view( 'dash.role.edit', compact('role', 'permissions') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->renew( $request );

        session()->flash( 'success', 'Role has been updated.' );

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->remove();
        
        session()->flash( 'success', 'Role has been removed.' );

        return back();
    }
}
