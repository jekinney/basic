@extends('layouts.dash')

@section('title', 'User List')

@section('content')
    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">

                <header class="panel-heading">
                    <h1 class="panel-title">User List</h1>
                </header>

                @include( 'dash.user.detail_table', ['users' => $users, 'full' => true] )

            </div>

        </div>

    </div>

    @include('dash.user.show_model', $users)
@endsection
