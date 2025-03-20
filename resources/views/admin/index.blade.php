@extends('admin.layout.main')

@section('title', 'Dashboard')

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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Payments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_transactions}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-credit-card fa-2x text-gray-300"></i>

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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">&#8358;{{ number_format($total_revenue, 2) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-naira-sign fa-2x text-gray-300"></i>


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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Amount Earned Today</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">&#8358;{{ number_format($today_revenue_earned, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-naira-sign fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Payment</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pending_transactions}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-spinner fa-2x text-gray-300"></i>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-lg-6">
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

        <div class="col-lg-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">Payment Activity</h6>
                    <a href="{{ route('payment') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body recent-activity">
                    @forelse($recent_transactions as $transaction)
                        <div class="d-flex mb-3 pb-3 border-bottom">
                            <div class="flex-shrink-0">
                                <img src="/image.webp" alt="User" class="rounded-circle" width="40" height="40">
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">{{ $transaction->name }} made a payment</h6>
                                <p class="small text-muted mb-0">
                                    Amount: <strong>₦{{ number_format($transaction->amount, 2) }}</strong><br>
                                    Status: <span class="badge
                                {{ $transaction->status == 'completed' ? 'badge-success' : 'badge-warning' }}">
                                {{ ucfirst($transaction->status) }}
                            </span><br>
                                    {{ $transaction->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No recent transactions found.</p>
                    @endforelse
                </div>
            </div>
        </div>


    </div>



@endsection
