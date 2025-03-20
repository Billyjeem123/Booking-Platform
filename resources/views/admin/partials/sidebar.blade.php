<!-- Sidebar -->
<div class="col-md-3 col-lg-2 sidebar" id="sidebar">
    <div class="position-sticky pt-3">
        <div class="d-flex align-items-center justify-content-center mb-4">
            <h3 class="fw-bold">Admin Panel</h3>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('admin.index')}}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('payment')}}">
                    <i class="fas fa-users"></i> Payments
                </a>
            </li>

        </ul>
    </div>
</div>
