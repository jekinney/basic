@extends('layouts.dash')

@section('title', 'Role Creater')

@section('content')
    <div class="col-md-4 col-md-offset-4">

        <div class="panel panel-default">

            <header class="panel-heading">
                <h1 class="panel-title">Role Creater</h1>
            </header>

            <form action="{{ route('dash.role.store') }}" method="post" class="panel-body">
                {{ csrf_field() }}

                @include( 'layouts.partials.dash.error_list' )

                <div class="form-group">
                    <label class="control-label" for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="description">Description</label>
                    <input type="text" id="description" name="description" value="{{ old('description') }}" class="form-control">
                </div>

                @foreach ( $permissions as $permission )
                    <div class="checkbox">
                        <label for="perm-{{ $permission->id }}">
                            <input type="checkbox" 
                                id="perm-{{ $permission->id }}" 
                                name="permissions[]" 
                                value="{{ $permission->id }}"
                            >
                            <strong>{{ $permission->name }}</strong> | {{ $permission->description }}
                        </label>
                    </div>
                @endforeach

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>

        </div>

    </div>
@endsection

