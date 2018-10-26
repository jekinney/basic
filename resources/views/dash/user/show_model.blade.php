@foreach ( $users as $user )
   <div class="modal fade" id="details-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="usersDetails{{ $user->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="usersDetails{{ $user->id }}">User's Details</h4>
                </div>

                <div class="modal-body">

                    <dl class="dl-horizontal">
                        <dt>Name:</dt>
                        <dd>{{ $user->name }}</dd>
                        <dt>Email:</dt>
                        <dd>{{ $user->email }}</dd>
                        <dt>Assigned Role:</dt>
                        @if ( $user->hasRole() )
                            <dd>{{ $user->role->name }}</dd>
                            <dt>Role's Description:</dt>
                            <dd>{{ $user->role->description }}</dd>
                        @else
                            <dd>None</dd>
                        @endif
                    </dl>

                    @if ( $user->hasRole() )

                        @include( 'dash.permission.detail_table', ['permissions' => $user->permissions()] )
                        
                    @endif

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endforeach
