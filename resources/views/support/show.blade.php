@extends('layouts.app')

@section('title', 'Show Support Request')

@section('content')
    <main class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">

                    <header class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="panel-title">Support Request</h1>
                            </div>
                            <div class="col-md-6 text-right">
                                Updated on: 
                            </div>
                        </div>
                    </header>

                    <section class="panel-body">
                        <div class="media">
                            <div class="media-body">
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

        </div>
    </main>
@endsection
