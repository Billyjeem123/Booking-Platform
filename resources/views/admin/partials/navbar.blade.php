<nav class="navbar navbar-expand-md navbar-light bg-light mb-4 p-3 shadow-sm">
    <div class="container-fluid">
        <button class="navbar-toggler border-0" type="button" id="sidebarToggle">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex align-items-center ms-auto">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="/image.webp" alt="User" width="32" height="32" class="rounded-circle me-2">
                    <span>{{auth()->user()->name}}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{route('admin.logout')}}">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
