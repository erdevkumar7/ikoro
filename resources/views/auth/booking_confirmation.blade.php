<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .email-container {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2c3e50;
        }
        p {
            font-size: 14px;
            line-height: 1.6;
            color: #333;
        }
        .details {
            margin-top: 15px;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #999;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Booking Confirmation</h2>
        <p>Hello {{ $booking->client->name ?? 'User' }},</p>

        <p>Thank you for your booking! Here are the details:</p>

        <div class="details">
            <p><strong>Gig:</strong> {{ $gig->title }}</p>
            <p><strong>Host:</strong> {{ $gig->host->user->name }}</p>
            <p><strong>Price:</strong> ${{ number_format($booking->price, 2) }}</p>
            <p><strong>Duration:</strong> {{ $booking->duration ?? 'N/A' }}</p>
            <p><strong>Date:</strong> {{ $booking->created_at->format('M d, Y h:i A') }}</p>
        </div>

        <p>We look forward to serving you.</p>

        {{-- <div class="footer">
            <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
        </div> --}}
    </div>
</body>
</html>
