@extends('admin.layout.main')

@section('title', 'Payment Logs')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Payment Logs</h3>
                    </div>

                    <div class="card-body table-responsive"> <!-- Enables scroll on small screens -->
                        <table id="payment-table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Destination</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Phone</th>
                                <th>Seat Number</th>
                                <th>Ticket ID</th>
                                <th>Date Paid</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->name }}</td>
                                    <td>{{ $transaction->email }}</td>
                                    <td>{{ $transaction->location }}</td>
                                    <td>₦{{ number_format($transaction->amount, 2) }}</td>
                                    <td>{{ $transaction->status }}</td>
                                    <td>{{ $transaction->phone }}</td>
                                    <td>{{ $transaction->seat_number ?? 'N/A' }}</td>
                                    <td>{{ $transaction->ticket_id ?? 'N/A' }}</td>
                                    <td>{{ $transaction->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No transactions found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer clearfix">
                        {{ $transactions->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Include Bootstrap DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#payment-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false, // Set to false to make horizontal scrolling work
                "pageLength": 10,  // Display 10 entries per page
            });
        });
    </script>
@endsection
