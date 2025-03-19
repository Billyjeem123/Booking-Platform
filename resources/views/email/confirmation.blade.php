<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            width: 600px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-header h1 {
            color: #1e90ff;
        }
        .email-content p {
            line-height: 1.6;
            color: #333;
        }
        .email-footer {
            text-align: center;
            margin-top: 30px;
            color: #999;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h1>NAIJAMOVE</h1>
        <p>Travel Booking Confirmation</p>
    </div>
    <div class="email-content">
        <p>Dear {{ $name }},</p>
        <p>We are pleased to confirm your travel booking with NAIJAMOVE. Below are the details of your trip:</p>

        <p><strong>Ticket ID:</strong> {{ $ticket_id }}<br>
            <strong>Route:</strong> {{ $origin }} to {{ $destination }}<br>
            <strong>Date of Departure:</strong> {{ $departure_date }}<br>
            <strong>Time of Departure:</strong> {{ $departure_time }}<br>
            <strong>Bus Type:</strong> {{ $bus_type }}<br>
            <strong>Seat Number:</strong> {{ $seat_number }}<br></p>

        <p>Please arrive at the departure location at least 30 minutes before the scheduled departure time.</p>

        <p>If you have any questions or concerns, please contact us at
            <strong>naijamove.com@gmail.com</strong> or <strong>+2349049751857</strong>.</p>

        <p>Thank you for choosing NAIJAMOVE. We look forward to having you on board.</p>

        <p>Best regards,<br>
            <strong>NAIJAMOVE</strong></p>
    </div>
    <div class="email-footer">
        &copy; {{ date('Y') }} NAIJAMOVE. All rights reserved.
    </div>
</div>
</body>
</html>
