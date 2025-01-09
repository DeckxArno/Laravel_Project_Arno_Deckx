<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <h2>Users</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Is Admin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                    <td>
                        @if (!$user->is_admin)
                            <form method="POST" action="{{ route('admin.makeAdmin', $user->id) }}">
                                @csrf
                                <button type="submit">Make Admin</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.removeAdmin', $user->id) }}">
                                @csrf
                                <button type="submit">Remove Admin</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
