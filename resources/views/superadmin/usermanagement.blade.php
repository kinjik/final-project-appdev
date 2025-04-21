<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Super Admin | Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/superadmin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidenav.css') }}">
</head>
<body>
    <div class="d-flex">
        @include('superadmin.sidenav')
        <!-- Main content -->
        <div class="main-content flex-grow-1 p-4">
            <h2 class="fw-bold text-warning mb-4">User Management</h2>
            <div class="line"></div>
            <h2 class="fw-100 text-primary mt-3">Assigned Admin Per Organization</h2>

            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Organization</th>
                                <th scope="col">Treasurer</th>
                                <th scope="col">Password</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        @php
                            $organizations = [
                                'APSS', 'AVED', 'BACOMMUNITY', 'BPED MOVERS', 'COFED', 'DIGITS',
                                'English Circle', 'EA', 'HRC', 'JSWAP', 'KMF', 'LNU MSS', 'INTERSOC',
                                'TC', 'TLEG TLE', 'SQU', 'ECEO', 'FCO', 'SCO', 'JCO', 'SENCO'
                            ];
                        @endphp
                        <tbody>
                            @foreach ($organizations as $name)
                                @php
                                    $admin = $admins->firstWhere('username', $name);
                                @endphp
                                <tr>
                                    <th scope="row">{{ $name }}</th>
                                    <td>{{ $admin->name ?? '' }}</td> <!-- Display the name of the person -->
                                    <td>{{ $admin->plain_password ?? '' }}</td>
                                    <td>
                                        @if($admin)
                                            <button class="btn btn-primary edit-btn"
                                                data-name="{{ $admin->name }}"
                                                data-password="{{ $admin->plain_password}}"
                                                data-id="{{ $admin->id }}"
                                                data-org="{{ $name }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal">
                                                EDIT
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit-username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="edit-name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="edit-password" class="form-label">Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="edit-password" name="password">
                                    <i class="bi bi-eye-slash toggle-edit-password" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="edit-id" name="id">
                            <input type="hidden" id="edit-organization" name="organization">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bootstrap JS (required for modals) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </div>

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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('.edit-btn');
            const editForm = document.getElementById('editUserForm');

            editButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const name = button.getAttribute('data-name');
                    const password = button.getAttribute('data-password');
                    const id = button.getAttribute('data-id');
                    const org = button.getAttribute('data-org');


                    document.getElementById('edit-name').value = name;
                    document.getElementById('edit-password').value = password;
                    document.getElementById('edit-id').value = id;
                    document.getElementById('edit-organization').value = org;

                    // Set the form action dynamically
                    editForm.action = `/admins/${id}`; // adjust if route is named differently
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.querySelector('.toggle-edit-password');
            const passwordField = document.getElementById('edit-password');

            togglePassword.addEventListener('click', function () {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);

                // Toggle eye icon
                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
            });
        });
    </script>
</body>
</html>
