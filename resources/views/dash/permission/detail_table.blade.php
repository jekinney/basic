 <table class="table">
    <caption class="text-center"><strong>Permission Details</strong></caption>
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $permissions as $permission )
            <tr>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->description }}</td>
            </tr>
        @endforeach
    </tbody>
</table>