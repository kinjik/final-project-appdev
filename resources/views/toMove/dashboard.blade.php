<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Super Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <h1>Welcome to the Super Admin Dashboard</h1>
        <h2>Admins List</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td>{{ $admin->username }}</td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->role }}</td>
                        <td>
                            <!-- You can add edit, delete buttons here -->
                            <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @if(session('alert'))
                    <script>
                        alert("{{ session('alert') }}");
                    </script>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

            </tbody>
        </table>
    </div>
</body>
</html>
