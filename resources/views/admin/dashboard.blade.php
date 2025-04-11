<!-- resources/views/admin/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

    <div class="container mt-5">
        <h1>Welcome to the Admin Dashboard</h1>
        <h2>Organization: <b style="color: royalblue">{{ $organization }}</b></h2>
        <p>Here, you can manage your organization and members.</p>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-warning">Logout</button>
        </form>
    </div>

</body>
</html>
