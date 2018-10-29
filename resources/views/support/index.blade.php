@extends('layouts.app')

@section('title', 'My Support Requests')

@section('content')
    <main class="container">
        <div class="row">

            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-default">

                    <header class="panel-heading">
                        <h1 class="panel-title">My Support Requests</h1>
                    </header>

                    @if ( count($support) > 0 )
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th class="text-center">Created On</th>
                                    <th class="text-center">Updated On</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $support as $sup )
                                    <tr>
                                        <th>{{ $sup->subject }}</th>
                                        <th class="text-center">{{ $sup->created_at->format( 'm-d-Y H:m a') }}</th>
                                        <th class="text-center">{{ $sup->updated_at->format( 'm-d-Y H:m a') }}</th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @else
                        
                        <div class="panel-body text-center">
                            <strong>No Support Requests.</strong>
                        </div>

                    @endif

                </div>

            </div>

        </div>
    </main>
@endsection
