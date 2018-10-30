<div class="modal fade" id="assign-{{ $support->id }}" tabindex="-1" role="dialog" aria-labelledby="assignSupport{{ $support->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('dash.support.update', $support) }}" method="post">
                <input type="hidden" name="_method" value="patch">
                {{ csrf_field() }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="assignSupport{{ $support->id }}">Assign to a User</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="assigned_id">Assign to:</label>
                        <select name="assigned_id" id="assigned_id" class="form-control" required>
                            <option @if( !$support->assigned_id ) selected @endif>Select a user</option>
                            @foreach ( $users as $user )
                                <option value="{{ $user->id }}" @if( $support->assigned_id === $user->id ) selected @endif>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>
