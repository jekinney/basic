@foreach ( $roles as $role )
   <div class="modal fade" id="details-{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="roleDetails{{ $role->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="roleDetails{{ $role->id }}">Role Details</h4>
                </div>

                <div class="modal-body">

                    <dl class="dl-horizontal">
                        <dt>Name:</dt>
                        <dd>{{ $role->name }}</dd>
                        <dt>User count:</dt>
                        <dd>{{ $role->users_count }}</dd>
                        <dt>Description:</dt>
                        <dd>{{ $role->description }}</dd>
                    </dl>

                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#perms" aria-controls="perms" role="tab" data-toggle="tab">Permissions</a></li>
                        <li role="presentation"><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Users</a></li>
                    </ul>

                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane fade in active" id="perms">
                            @include( 'dash.permission.detail_table', ['permissions' => $role->permissions] )
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="users">
                            @include( 'dash.user.detail_table', ['users' => $role->users] )
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endforeach
