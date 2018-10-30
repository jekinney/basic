@extends('layouts.dash')

@section('title', 'Update Support Request')

@section('content')
    <main class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">

                    <header class="panel-heading">
                        <div class="row">
                            <div class="col-md-10">
                                <h1 class="panel-title">Update Support Request</h1>
                            </div>
                            <div class="col-md-2 text-right">
                                <button data-toggle="modal" data-target="#assign-{{ $support->id }}" class="btn btn-xs btn-default">
                                    Assign
                                </button>
                            </div>
                        </div>
                    </header>

                    <section class="panel-body">
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading">{{ $support->name }} sent a request on {{ $support->created_at->format( 'm-d-Y H:m a') }}</h4>
                                <hr>
                                <h4 class="media-heading">{{ $support->subject }}</h4>
                                {{ $support->message }}

                                @if ( $support->replies->count() > 0 )

                                    @include( 'support.show_replies', ['replies' => $support->replies] )

                                @endif
                            </div>
                        </div>

                    </section>

                </div>

            </div>

            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">

                    <header class="panel-heading">
                        <h2 class="panel-title">Add Reply</h2>
                    </header>

                    <div class="panel-body">
                        <form action="{{ route('support-reply.store') }}" method="post" role="form">
                            <input type="hidden" name="support_id" value="{{ $support->id }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="message">Reply</label>
                                <textarea name="message" id="message" class="form-control" required>{{ old('message') }}</textarea>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">Add Reply</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>

    </main>
    @include( 'dash.support.assign_modal', ['support' => $support, 'users' => $admins] )
@endsection
