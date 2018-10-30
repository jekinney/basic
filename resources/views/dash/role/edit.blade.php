@extends('layouts.dash')

@section('title', 'Role Editor')

@section('content')
    <div class="col-md-4 col-md-offset-4">

        <div class="panel panel-default">

            <header class="panel-heading">
                <h1 class="panel-title">Role Editor</h1>
            </header>

            <form action="{{ route('dash.role.update', $role) }}" method="post" class="panel-body">
                <input type="hidden" name="_method" value="patch">
                {{ csrf_field() }}

                @include( 'layouts.partials.dash.error_list' )

                <div class="form-group">
                    <label class="control-label" for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name')?? $role->name }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="description">Description</label>
                    <input type="text" id="description" name="description" value="{{ old('description')?? $role->description }}" class="form-control">
                </div>

                @foreach ( $permissions as $permission )
                    <div class="checkbox">
                        <label for="perm-{{ $permission->id }}">
                            <input type="checkbox" 
                                id="perm-{{ $permission->id }}" 
                                name="permissions[]" 
                                value="{{ $permission->id }}"
                                @if( $role->permissions->contains('id', $permission->id) ) checked @endif
                            >
                            <strong>{{ $permission->name }}</strong> | {{ $permission->description }}
                        </label>
                    </div>
                @endforeach

                <div class="row">
                    <div class="col-md-6">
                        <button type="button" data-toggle="modal" data-target="#confirm" class="btn btn-danger">Remove</button>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>

            </form>

        </div>

    </div>

    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="removeConfirmation">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('dash.role.destroy', $role) }}" method="post">
                    <input type="hidden" name="_method" value="delete">
                    {{ @csrf_field() }}

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="roleDetails{{ $role->id }}">Remove Role</h4>
                    </div>

                    <div class="modal-body text-center">
                        <strong>Please confirm you want to remove {{ $role->name }}.</strong>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Confirm Remove</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
