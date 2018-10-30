@extends('layouts.app')

@section('title', 'Edit my profile')

@section('content')
    <main class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">

                    <header class="panel-heading">
                        <h1 class="panel-title">Edit profile details</h1>
                    </header>

                    <section class="panel-body">

                        @if ( count($errors) > 0 )
                            <div class="alert alert-danger">
                                <ul class="list-unstyled"> 
                                    @foreach( $errors->all() as $error )
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div class="row">

                            <div class="col-md-6">
                                <div class="panel panel-default">

                                    <header class="panel-heading">
                                        <h1 class="panel-title">Update Name</h1>
                                    </header>

                                    <section class="panel-body">
                                        <form action="{{ route('profile.name') }}" method="post" class="form-inline">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </section>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="panel panel-default">

                                    <header class="panel-heading">
                                        <h1 class="panel-title">Update Email Address</h1>
                                    </header>

                                    <section class="panel-body">
                                        <form action="{{ route('profile.email') }}" method="post" class="form-inline">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </section>

                                </div>
                            </div>

                        </div>

                        <div class="panel panel-default">

                            <header class="panel-heading">
                                <h1 class="panel-title">Update Password</h1>
                            </header>

                            <section class="panel-body">
                                <form action="{{ route('profile.password') }}" method="post" class="form-horizontal">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="current_password" class="col-sm-4 control-label">Current Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="current_password" id="current_password" class="form-control">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="password" class="col-sm-4 control-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation" class="col-sm-4 control-label">Confirm Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                        
                            </section>

                        </div>

                    </section>
                </div>

            </div>

        </div>
    </main>
@endsection
