<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
            width: 50%;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #eee;
        }

        .label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            color: #333;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>

<body>
    <h2>Invoice for Booking #{{ $booking->id }}</h2>

    <table>
        <tr>
            <!-- Booking Details -->
            <td>
                <span class="label">Booking Task:</span> {{ $booking->gig->task->title ?? 'N/A' }}<br>
                <span class="label">Host Name:</span> {{ $booking->host->name ?? 'N/A' }}<br>
                <span class="label">Tool Used:</span> {{ $booking->equipment_name ?? 'N/A' }}<br>
                <span class="label">Duration:</span> {{ $booking->duration }}<br>
                <span class="label">Operation Time:</span> {{ $booking->operation_time }}<br>
                <span class="label">Host Notes:</span> {{ $booking->host_notes ?? 'N/A' }}
            </td>

            <!-- Payment Details -->
            <td>
                <span class="label">Amount Paid:</span> ${{ number_format($booking->payment->amount, 2) }}<br>
                <span class="label">Currency:</span> {{ strtoupper($booking->payment->currency) }}<br>
                <span class="label">Payment Status:</span> {{ ucfirst($booking->payment->status) }}<br>
                <span class="label">Payment Method:</span> {{ $booking->payment->payment_type ?? 'N/A' }}<br>
                <span class="label">Transaction ID:</span> {{ $booking->payment->payment_intent_id }}
            </td>
        </tr>
    </table>

    <div class="footer">
        <p>Thank you for your booking!</p>
    </div>
</body>

</html>
