@extends('layouts.dash')

@section('title', 'Support Request List')

@section('content')
    <div class="panel panel-default">

        <header class="panel-heading">
            <h1 class="panel-title">Support Requests</h1>
        </header>

        <table class="table">
            <thead>
                <tr>
                    <th width="10%">Name</th>
                    <th width="10%">Email</th>
                    <th>Subject</th>
                    <th class="text-center" width="5%">Replies</th>
                     @if ( auth()->user()->hasPerm('view-support') )
                        <th class="text-center" width="5%">Assigned</th>
                    @endif
                    <th class="text-center" width="10%">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $support as $sup )
                    <tr>
                        <td>{{ $sup->name }}</td>
                        <td>{{ $sup->email }}</td>
                        <td>{{ $sup->subject }}</td>
                        <td class="text-center">{{ $sup->replies_count }}</td>
                         @if ( auth()->user()->hasPerm('view-support') )
                            <td class="text-center">{{ $sup->assigned? $sup->assigned->name:'No' }}</td>
                        @endif
                        <td class="text-center">
                            <a href="{{ route('dash.support.edit', $sup) }}" class="btn btn-sm btn-info">Details</a>
                            @if ( auth()->user()->hasPerm('view-support') )
                                <button data-toggle="modal" data-target="#assign-{{ $sup->id }}" class="btn btn-sm btn-default">
                                    Assign
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    @foreach ( $support as $sup )

        @include( 'dash.support.assign_modal', ['support' => $sup, 'users' => $admins] )

    @endforeach
@endsection
