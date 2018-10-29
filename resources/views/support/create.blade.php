@extends('layouts.app')

@section('title', 'Support Request')

@section('content')
    <main class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">

                    <header class="panel-heading">
                        <h1 class="panel-title">Contact and Support Request</h1>
                    </header>

                    <form action="{{ route('support.store') }}" method="post" class="panel-body">
                        {{ csrf_field() }}

                        <div class="row">

                            <div class="form-group col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name</label>
                                <input type="text" 
                                    name="name" 
                                    id="name" 
                                    value="{{ auth()->check()? auth()->user()->name:old('name') }}" 
                                    class="form-control"
                                    @if ( auth()->check() ) readonly="true" @endif
                                    required
                                >
                                @if ( $errors->has('name') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email</label>
                                <input type="text" 
                                    name="email" 
                                    id="email" 
                                    value="{{ auth()->check()? auth()->user()->email:old('email') }}" 
                                    class="form-control"
                                    @if ( auth()->check() ) readonly="true" @endif
                                    required
                                >
                                @if ( $errors->has('email') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group {{ $errors->has('subject') ? ' has-error' : '' }}">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" class="form-control" required>
                            @if ( $errors->has('subject') )
                                <span class="help-block">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" class="form-control" rows="10" required>{{ old('message') }}</textarea>
                            @if ( $errors->has('message') )
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label for="reply_required">
                                        <input type="checkbox" name="reply_required" id="reply_required" value="1" @if ( old('reply_required') ) checked="true" @endif>
                                        <strong>Request Reply?</strong>
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </main>
@endsection
