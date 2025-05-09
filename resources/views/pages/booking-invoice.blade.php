<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body { font-family: sans-serif; }
        .header { border-bottom: 1px solid #ccc; margin-bottom: 20px; padding-bottom: 10px; }
        .section { margin-bottom: 20px; }
        .label { font-weight: bold; }
    </style>
</head>
<body>
    <h2>Invoice for Booking #{{ $booking->id }}</h2>

    <div class="section">
        <div class="label">Booking Task:</div> {{ $booking->gig->task->title ?? 'N/A' }}
        <div class="label">Tool:</div> {{ $booking->equipment_name ?? 'N/A' }}
        <div class="label">Duration:</div> {{ $booking->duration }}
        <div class="label">Operation Time:</div> {{ $booking->operation_time }}
        <div class="label">Host Notes:</div> {{ $booking->host_notes ?? 'N/A' }}
    </div>

    <div class="section">
        <div class="label">Amount Paid:</div> ${{ number_format($booking->payment->amount, 2) }}
        <div class="label">Currency:</div> {{ strtoupper($booking->payment->currency) }}
        <div class="label">Payment Status:</div> {{ ucfirst($booking->payment->status) }}
        <div class="label">Payment Method:</div> {{ $booking->payment->payment_type ?? 'N/A' }}
        <div class="label">Transaction ID:</div> {{ $booking->payment->payment_intent_id }}
    </div>

    <div class="footer">
        <p>Thank you for your booking!</p>
    </div>
</body>
</html>
