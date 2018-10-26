<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            @if ( isset($full) )
                <th class="text-center">Role</th>
                <th class="text-center">Status</th>
                <th class="text-center">Options</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ( $users as $user )
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                @if ( isset($full) )
                    <td>{{ $user->role->name?? 'None' }}</td>
                    <td class="{{ $user->status()->class }}">{{ $user->status()->text }}</td>
                    <td class="text-center">
                        <a href="{{ route('dash.user.edit', $user) }}" class="btn btn-sm btn-info">Edit</a>
                        <button data-toggle="modal" data-target="#details-{{ $user->id }}" class="btn btn-sm btn-default">Details</button>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>