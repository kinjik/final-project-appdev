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
        @include('sidenav')

        <!-- Main content -->
        <div class="main-content flex-grow-1 p-4">
            <h2 class="fw-bold text-warning mb-4">👋 Hello, Super Admin!</h2>

            <div class="row">
                @php
                    $organizations = [
                        (object)[ 'acronym' => 'APSS', 'full_name' => 'Association of Political Science Students', 'total_members' => 20 ],
                        (object)[ 'acronym' => 'AVED', 'full_name' => 'Association of Values Educators', 'total_members' => 20 ],
                        (object)[ 'acronym' => 'BACOMMUNITY', 'full_name' => 'BA Community', 'total_members' => 18 ],
                        (object)[ 'acronym' => 'BPED MOVERS', 'full_name' => 'Bachelor of Phydical Education Movers', 'total_members' => 18 ],
                        (object)[ 'acronym' => 'COFED', 'full_name' => 'Circle of Future Eductaors', 'total_members' => 18 ],
                        (object)[ 'acronym' => 'DIGITS', 'full_name' => 'Developmental Integrated Group of Information Technology Student', 'total_members' => 25 ],
                        (object)[ 'acronym' => 'ENGLISH CIRCLE ', 'full_name' => '', 'total_members' => 18 ],
                        (object)[ 'acronym' => 'EA', 'full_name' => 'Entrepreneur\'s Association', 'total_members' => 18 ],
                        (object)[ 'acronym' => 'HRC', 'full_name' => 'Hoteliers and Restaurateurs Circle', 'total_members' => 18 ],
                        (object)[ 'acronym' => 'JSWAP', 'full_name' => 'Juniors Social Workers Association of the Philippines', 'total_members' => 20 ],
                        (object)[ 'acronym' => 'KMF', 'full_name' => 'Kapisanang Maka-Filipino', 'total_members' => 20 ],
                        (object)[ 'acronym' => 'LNU MSS', 'full_name' => 'Math Students Society', 'total_members' => 20 ],
                        (object)[ 'acronym' => 'LNU INTERSOC', 'full_name' => 'INTERACT SOCIETY', 'total_members' => 20 ],
                        (object)[ 'acronym' => 'TC', 'full_name' => 'Tourism Circle', 'total_members' => 20 ],
                        (object)[ 'acronym' => 'TLEG', 'full_name' => 'TLE Guild', 'total_members' => 20 ],
                        (object)[ 'acronym' => 'SQU', 'full_name' => 'Science Questers Unlimited', 'total_members' => 20 ],
                        (object)[ 'acronym' => 'FCO', 'full_name' => 'Freshmen Class Organization', 'total_members' => 30 ],
                        (object)[ 'acronym' => 'SCO', 'full_name' => 'Sophomore Class Organization', 'total_members' => 22 ],
                        (object)[ 'acronym' => 'JCO', 'full_name' => 'Junior Class Organization', 'total_members' => 20 ],
                        (object)[ 'acronym' => 'SENCO', 'full_name' => 'Senior\'s Class Organization', 'total_members' => 20 ],
                    ];
                @endphp

                @foreach ($organizations as $org)
                <div class="col-12 mb-3">
                    <div class="card-custom shadow-sm d-flex justify-content-between align-items-center">
                        <div class="line-separator"></div>
                        <div class="d-flex align-items-center gap-3">
                            <div></div>
                            <div>
                               
                                <h3 class="fw-bold org-title mb-1">{{ strtoupper($org->acronym) }}</h3>
                                <p class="mb-0">{{ $org->full_name }}</p>
                            </div>
                        </div>
                        <div class="text-end">
                            <small>Total Members:</small>
                            <h5 class="fw-semibold">{{ $org->total_members }}</h5>
                        </div>
                    </div>
                </div>
                
                @endforeach
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
</body>
</html>
