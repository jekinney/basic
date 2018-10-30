@extends('layouts.dash')

@section('title', 'User Editor')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">

                <header class="panel-heading">
                    <h1 class="panel-title">User Editor</h1>
                </header>

                <form action="{{ route('dash.user.update', $user) }}" method="post" class="panel-body">
                    <input type="hidden" name="_method" value="patch">
                    {{ csrf_field() }}

                    @include( 'layouts.partials.dash.error_list' )

                    <div class="row">

                        <div class="form-group col-md-4">
                            <label class="control-label" for="name">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name')?? $user->name }}" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label class="control-label">Email</label>
                            <input type="email" value="{{ $user->email }}" class="form-control" readonly="true">
                        </div> 

                        <div class="form-group col-md-4">
                            <label class="control-label" for="role_id">Role</label>
                            <select id="role_id" name="role_id" class="form-control">
                                <option value="0" @if ( $user->role_id === 0 ) selected @endif>None</option>
                                @foreach ( $roles as $role )
                                    <option value="{{ $role->id }}" @if ( $user->role_id === $role->id ) selected @endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" data-toggle="modal" data-target="#confirm" class="btn btn-danger">Toggle Ban</button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>

    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="banConfirmation">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('dash.user.ban', $user) }}" method="post">
                    <input type="hidden" name="_method" value="put">
                    {{ @csrf_field() }}

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="banConfirmation">Ban User</h4>
                    </div>

                    <div class="modal-body text-center">
                        <strong>Please confirm ban or un-ban {{ $user->name }}.</strong>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Confirm</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

