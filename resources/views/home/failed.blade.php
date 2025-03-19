<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Failed</title>
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
                <div class="card-header bg-danger text-white">
                    <h3 class="text-center mb-0">Payment Failed</h3>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-times-circle text-danger" style="font-size: 80px;"></i>
                    </div>

                    <h4>Your payment could not be processed</h4>

                    <p class="mb-1">We're sorry, but there was an issue processing your payment.</p>
                    <p class="mb-4">Please check your payment details and try again.</p>

                    <div class="payment-info bg-light p-3 rounded mb-4">
                        <h5>Payment Information</h5>
                        <p class="mb-1"><strong>Error Code:</strong> #ERR-{{ rand(1000, 9999) }}</p>
                        <p class="mb-0"><strong>Date:</strong> {{ date('M d, Y') }}</p>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="" class="btn btn-primary btn-lg mb-2">
                            <i class="fas fa-credit-card me-2"></i> Try Again
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-home me-2"></i> Back to Home
                        </a>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-center mb-0">If you need assistance, please contact our support team at support@example.com</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
