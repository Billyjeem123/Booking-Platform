<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Successful</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header bg-success text-white">
                    <h3 class="text-center mb-0">Payment Successful!</h3>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                    </div>

                    <h4>Thank you for your payment</h4>

                    <p class="mb-1">Your transaction has been completed successfully.</p>
                    <p class="mb-4">Please check your email for your ticket and further instructions.</p>

                    <div class="payment-info bg-light p-3 rounded mb-4">
                        <h5>Payment Information</h5>
                        <p class="mb-1"><strong>Transaction ID:</strong> {{$ticket}}</p>
                        <p class="mb-0"><strong>Date:</strong> {{ date('M d, Y') }}</p>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-home me-2"></i> Back to Home
                        </a>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-center mb-0">If you have any questions, please contact our support team.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
