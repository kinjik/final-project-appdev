<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" href="{{ asset('css/sidenav.css') }}">
<button class="toggle-btn">
    <i class="bi bi-list"></i>
</button>

<div class="sidebar p-4">
    <h5 class="fw-bold text-center mb-4">{{ $organization }}Admin</h5>
    <ul class="nav flex-column">
        <li class="nav-item mb-3">
            <a class="nav-link d-flex align-items-center text-decoration-none" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-house-door me-2"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item mb-3">
            {{-- <a class="nav-link d-flex align-items-center" href="{{ route('payment.dashboard') }}">
                <i class="bi bi-people-fill me-2"></i> <span>Add Payment</span>
            </a> --}}
            <a class="nav-link d-flex align-items-center"  href="{{ route('admin.members') }}" >
                <i class="bi bi-people-fill me-2"></i> <span>Members</span>
            </a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link d-flex align-items-center" href="{{ route('admin.showaddpayment') }}">
                <i class="bi bi-credit-card me-2"></i> <span>Add Payment</span>
            </a>
            {{-- <a class="nav-link d-flex align-items-center">
                <i class="bi bi-people-fill me-2"></i> <span>Add Payment</span>
            </a> --}}
        </li>

        <li class="nav-item mb-3">
            {{-- <a class="nav-link d-flex align-items-center" href="{{ route('payment.dashboard') }}">
                <i class="bi bi-people-fill me-2"></i> <span>Add Payment</span>
            </a> --}}
            <a class="nav-link d-flex align-items-center" >
                <i class="bi bi-clock-history me-2"></i> <span>Payment History</span>
            </a>
        </li>
        <li class="nav-item">
            {{-- <a href="{{ route('logout') }}" class="nav-link d-flex align-items-center">
                <i class="bi bi-box-arrow-right me-2"></i> <span>Log Out</span>
            </a> --}}
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-link d-flex align-items-center" >
                    <i class="bi bi-box-arrow-right me-2"></i> <span>Log Out</span>
                </button>
            </form>
        </li>
    </ul>
</div>
