<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin - Students</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sidenav.css') }}">
    </head>
    <body>
        <div class="d-flex">
            @include('admin.sidenav')

            <!-- Main content -->
            <div class="main-content flex-grow-1 p-4">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Whoops!</strong> Please fix the following errors:
                        <ul class="mb-0 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h2 class="fw-bold text-warning mb-4">👋 Hello, {{ $organization }} - Students List</h2>
                <!-- Add Student Button -->
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                        <i class="bi bi-person-plus"></i> Add Student
                    </button>
                </div>
                @php
                    function ordinal($number) {
                        if (!in_array(($number % 100), [11, 12, 13])) {
                            return match ($number % 10) {
                                1 => $number . 'st',
                                2 => $number . 'nd',
                                3 => $number . 'rd',
                                default => $number . 'th',
                            };
                        }
                        return $number . 'th';
                    }
                @endphp
                <!-- Filter Form -->
                <form method="GET" action="{{ route('admin.members') }}" class="mb-4">
                    <select name="section" class="form-select" id="sectionDropdown" style="max-width: 200px; display: inline-block;" onchange="this.form.submit()">
                        <option value="">Show All</option>
                        @foreach ($groupedSections as $year => $sections)
                            <optgroup label="{{ ordinal($year) }} Year">
                                @foreach ($sections as $sec)
                                    <option value="{{ $sec }}" {{ $section == $sec ? 'selected' : '' }}>
                                        {{ ordinal((int) substr($sec, 2, 1)) }} Year - {{ $sec }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </form>

                <!-- Students Table -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Student Id</th>
                            <th>Name</th>
                            <th>Contact Number</th>
                            <th>Year Level</th>
                            <th>Section</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $student->id_number }}</td>
                                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                <td>{{ $student->contact_number }}</td>
                                <td> Year {{ $student->year_level }}</td>
                                <td>{{ $student->section }}</td>
                                <td>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editStudentModal{{ $student->id }}">Edit</button>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#transferModal{{ $student->id }}">Transfer</button>
                                </td>
                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editStudentModal{{ $student->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('admin.students.update', $student->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Student</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input name="first_name" class="form-control mb-2" value="{{ $student->first_name }}" required>
                                                <input name="last_name" class="form-control mb-2" value="{{ $student->last_name }}" required>
                                                <input name="contact_number" class="form-control mb-2" value="{{ $student->contact_number }}" required>
                                                <input name="id_number" class="form-control mb-2" value="{{ $student->id_number }}" required>
                                                <div class="mb-2">
                                                    <label class="form-label">Year Level</label>
                                                    <select name="year_level" class="form-select" required>
                                                        @foreach (range(1, 4) as $level)
                                                            <option value="{{ $level }}" {{ $student->year_level == $level ? 'selected' : '' }}>
                                                                {{ $level }}{{ ['st','nd','rd','th'][$level-1] ?? 'th' }} Year
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input name="section" class="form-control mb-2" value="{{ $student->section }}" required>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Transfer Modal -->
                            <div class="modal fade" id="transferModal{{ $student->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('admin.students.transfer', $student->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Transfer Student</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label class="form-label fw-semibold">Select Organization</label>
                                                <select name="organization" class="form-select" required>
                                                    <option value="">-- Choose Organization --</option>
                                                    @foreach($allOrganizations as $org)
                                                        <option value="{{ $org }}" {{ $student->organization == $org ? 'selected' : '' }}>
                                                            {{ $org }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-warning">Transfer</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No students found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Add Student Modal -->
                <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('admin.students.store') }}">
                            @csrf
                            <div class="modal-content rounded-4 border-0 shadow">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold ">First Name</label>
                                        <input type="text" name="first_name" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold ">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold ">Contact Number</label>
                                        <input type="text" name="contact_number" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold ">ID Number</label>
                                        <input type="text" name="id_number" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold ">Year Level</label>
                                        <select name="year_level" class="form-select">
                                            @foreach (range(1,4) as $level)
                                                <option value="{{ $level }}">{{ ordinal($level) }} Year</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold ">Section</label>
                                        <input type="text" name="section" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Organization</label>
                                        <input type="text" class="form-control" value="{{ $organization }}" readonly>
                                        <input type="hidden" name="organization" value="{{ $organization }}">
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-success">Save Student</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const sectionDropdown = document.getElementById('sectionDropdown');
                sectionDropdown.addEventListener('change', function () {
                    this.form.submit(); // Automatically submit the form on change
                });
            });
        </script>
        <script>
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    new bootstrap.Alert(alert).close();
                });
            }, 5000); // Close after 5 seconds
        </script>
    </body>
</html>
