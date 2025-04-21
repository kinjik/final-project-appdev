<!-- resources/views/admin/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin Add Payment</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/sidenav.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    </head>
    <body>
        <div class="d-flex">
            @include('admin.sidenav')

            <!-- Main content -->
            <div class="main-content flex-grow-1 p-4">
                <h2 class="fw-bold text-warning mb-4">👋 Hello, {{$organization}} Add Payment here!</h2>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const toggleBtn = document.querySelector('.toggle-btn');
                const sidebar = document.querySelector('.sidebar');
                const mainContent = document.querySelector('.main-content');

                toggleBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('open');
                    mainContent.classList.toggle('shifted');
                });
            });
        </script>
    </body>
</html>
