@extends('admin.layout.main')

@section('title', 'Manage Services')

@section('content')


    <!-- Dashboard Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Print</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <i class="fas fa-calendar"></i> This Week
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-0 shadow-sm h-100" style="border-left-color: #4e73df !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">10,521</div>
                            <div class="mt-2 text-success small"><i class="fas fa-arrow-up"></i> 12% since last month</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-0 shadow-sm h-100" style="border-left-color: #1cc88a !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                            <div class="mt-2 text-success small"><i class="fas fa-arrow-up"></i> 8% since last month</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-0 shadow-sm h-100" style="border-left-color: #36b9cc !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">New Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">842</div>
                            <div class="mt-2 text-danger small"><i class="fas fa-arrow-down"></i> 3% since last month</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-0 shadow-sm h-100" style="border-left-color: #f6c23e !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Tasks</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            <div class="mt-2 text-success small"><i class="fas fa-check"></i> 5 completed today</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-transparent">
                    <h6 class="m-0 font-weight-bold">Revenue Overview</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-transparent">
                    <h6 class="m-0 font-weight-bold">Traffic Sources</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="trafficChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity and Users Row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">Recent Activity</h6>
                    <a href="#" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body recent-activity">
                    <div class="d-flex mb-3 pb-3 border-bottom">
                        <div class="flex-shrink-0">
                            <img src="/api/placeholder/40/40" alt="User" class="rounded-circle" width="40" height="40">
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-1">John Doe updated their profile</h6>
                            <p class="small text-muted mb-0">15 minutes ago</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3 pb-3 border-bottom">
                        <div class="flex-shrink-0">
                            <img src="/api/placeholder/40/40" alt="User" class="rounded-circle" width="40" height="40">
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-1">Jane Smith placed a new order</h6>
                            <p class="small text-muted mb-0">45 minutes ago</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3 pb-3 border-bottom">
                        <div class="flex-shrink-0">
                            <img src="/api/placeholder/40/40" alt="User" class="rounded-circle" width="40" height="40">
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-1">Mike Johnson created a new account</h6>
                            <p class="small text-muted mb-0">1 hour ago</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3 pb-3 border-bottom">
                        <div class="flex-shrink-0">
                            <img src="/api/placeholder/40/40" alt="User" class="rounded-circle" width="40" height="40">
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-1">Sarah Williams updated product #1234</h6>
                            <p class="small text-muted mb-0">2 hours ago</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="/api/placeholder/40/40" alt="User" class="rounded-circle" width="40" height="40">
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-1">Alex Brown commented on an order</h6>
                            <p class="small text-muted mb-0">3 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">Recent Users</h6>
                    <a href="#" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="/api/placeholder/36/36" alt="" class="rounded-circle me-2" width="36" height="36">
                                    <div>
                                        <h6 class="mb-0">John Doe</h6>
                                        <small class="text-muted">john@example.com</small>
                                    </div>
                                </div>
                            </td>
                            <td>Admin</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="/api/placeholder/36/36" alt="" class="rounded-circle me-2" width="36" height="36">
                                    <div>
                                        <h6 class="mb-0">Jane Smith</h6>
                                        <small class="text-muted">jane@example.com</small>
                                    </div>
                                </div>
                            </td>
                            <td>User</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="/api/placeholder/36/36" alt="" class="rounded-circle me-2" width="36" height="36">
                                    <div>
                                        <h6 class="mb-0">Mike Johnson</h6>
                                        <small class="text-muted">mike@example.com</small>
                                    </div>
                                </div>
                            </td>
                            <td>Editor</td>
                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="/api/placeholder/36/36" alt="" class="rounded-circle me-2" width="36" height="36">
                                    <div>
                                        <h6 class="mb-0">Sarah Williams</h6>
                                        <small class="text-muted">sarah@example.com</small>
                                    </div>
                                </div>
                            </td>
                            <td>User</td>
                            <td><span class="badge bg-danger">Inactive</span></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
