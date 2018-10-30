@extends('layouts.dash')

@section('title', 'Role List')

@section('content')
    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default">

                <header class="panel-heading">
                    <div class="row">
                        <h1 class="panel-title col-md-10">Role List</h1>
                        <div class="col-md-2 text-right">
                            <a href="{{ route('dash.role.create') }}" class="btn btn-xs btn-info">Add Role</a>
                        </div>
                    </div>
                </header>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th class="text-center" width="15%">Users</th>
                            <th class="text-center" width="20%">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $roles as $role )
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td class="text-center">{{ $role->users_count }}</td>
                                <td class="text-center">
                                    <a href="{{ route('dash.role.edit', $role) }}" class="btn btn-sm btn-info">Edit</a>
                                    <button data-toggle="modal" data-target="#details-{{ $role->id }}" class="btn btn-sm btn-default">Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </div>

    @include( 'dash.role.show_model', $roles )
@endsection
