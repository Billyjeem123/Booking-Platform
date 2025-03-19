<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: white;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }
        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: -100%;
                width: 250px;
                transition: all 0.3s;
            }
            .sidebar.show {
                left: 0;
            }
            .main-content {
                width: 100%;
                margin-left: 0;
            }
        }
        .main-content {
            transition: margin-left 0.3s;
        }
        @media (min-width: 768px) {
            .main-content {
                margin-left: 250px;
            }
        }
        .stat-card {
            border-radius: 10px;
            border-left: 5px solid;
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
            padding: 0.75rem 1rem;
            margin-bottom: 0.25rem;
            border-radius: 0.25rem;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link i {
            margin-right: 0.5rem;
        }
        .chart-container {
            height: 300px;
        }
        .recent-activity {
            height: 300px;
            overflow-y: auto;
        }
        .backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 99;
        }
        .backdrop.show {
            display: block;
        }
    </style>
</head>
<body>
<div class="backdrop" id="backdrop"></div>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar" id="sidebar">
            <div class="position-sticky pt-3">
                <div class="d-flex align-items-center justify-content-center mb-4">
                    <h3 class="fw-bold">Admin Panel</h3>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users"></i> Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-shopping-cart"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-clipboard-list"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-chart-bar"></i> Analytics
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 main-content">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-md navbar-light bg-light mb-4 p-3 shadow-sm">
                <div class="container-fluid">
                    <button class="navbar-toggler border-0" type="button" id="sidebarToggle">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="d-flex align-items-center ms-auto">
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/api/placeholder/32/32" alt="User" width="32" height="32" class="rounded-circle me-2">
                                <span>Admin User</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

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
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
    // Sidebar Toggle Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('backdrop');

        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            backdrop.classList.toggle('show');
        });

        backdrop.addEventListener('click', function() {
            sidebar.classList.remove('show');
            backdrop.classList.remove('show');
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('show');
                backdrop.classList.remove('show');
            }
        });
    });

    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Revenue',
                data: [15000, 21000, 18000, 24000, 23000, 24000, 28000, 26000, 30000, 32000, 30000, 34000],
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderColor: 'rgba(78, 115, 223, 1)',
                pointRadius: 3,
                pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointBorderColor: 'rgba(78, 115, 223, 1)',
                pointHoverRadius: 5,
                pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                pointHitRadius: 10,
                pointBorderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                },
                y: {
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });

    // Traffic Chart
    const trafficCtx = document.getElementById('trafficChart').getContext('2d');
    const trafficChart = new Chart(trafficCtx, {
        type: 'doughnut',
        data: {
            labels: ['Direct', 'Social', 'Referral', 'Organic'],
            datasets: [{
                data: [30, 25, 20, 25],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                hoverBackgroundColor: ['#3a5ecf', '#17a673', '#2c9faf', '#e0b128'],
                hoverBorderColor: 'rgba(234, 236, 244, 1)',
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    display: true
                }
            }
        }
    });
</script>
</body>
</html>
