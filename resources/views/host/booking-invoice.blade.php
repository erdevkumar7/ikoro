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

        .badge-danger {
            color: #fff;
            background-color: #dc3545;
        }

        .badge-warning {
            color: #1f2d3d;
            background-color: #ffc107;
        }

        .badge-success {
            color: #fff;
            background-color: #28a745;
        }
    </style>
</head>

<body>
    <h2>Invoice for Booking #{{ $booking->id }}</h2>

    <table>
        <tr>
            <!-- Booking Details -->
            <td>
                <span class="label">Booking Id:</span> {{ $booking->id }}<br>
                <span class="label">Booking Task:</span> {{ $booking->gig->task->title }}<br>
                <span class="label">User Name:</span> {{ $booking->client->name ?? 'N/A' }}<br>
                <span class="label">User Email:</span> {{ $booking->client->email }}<br>
                @if ($booking->clientDetails->feedback_tool == 'Skype')
                    <span class="label">User-Skype: </span> {{ $booking->clientDetails->skype }}<br>
                @elseif($booking->clientDetails->feedback_tool == 'WhatsApp')
                    <span class="label">User-WhatsApp: </spane> {{ $booking->clientDetails->whatsapp }}<br>
                @endif
                <span class="label">Tool Used:</span> {{ $booking->equipment_name ?? 'N/A' }}<br>
                <span class="label">Booking Status:</span>
                @if ($booking['is_accepted'] == 'accepted')
                    <span class="badge badge-success">Accepted</span>
                @elseif($booking['is_accepted'] == 'pending')
                    <span class="badge badge-warning">Pending</span>
                @elseif($booking['is_accepted'] == 'rejected')
                    <span class="badge badge-danger">Rejected</span>
                @endif
                <br>
                <span class="label">Payment Release: </span>
                @if ($booking['client_status'] == 'done' && $booking['host_status'] == 'done' && $booking['payment_status'] == 1)
                    <span class="badge badge-success"> Released </span>
                @elseif ($booking['client_status'] == 'done' && $booking['host_status'] == 'done')
                    <span class="badge badge-success"> Ready to Release </span>
                @elseif($booking['client_status'] == 'pending' || $booking['host_status'] == 'pending')
                    <span class="badge badge-warning"> Pending </span>
                @endif
                <br>
                <span class="label">Duration:</span> {{ $booking->duration }}<br>
                <span class="label">Operation Time:</span> {{ $booking->operation_time }}<br>
                <span class="label">Host Notes:</span> {{ $booking->host_notes ?? 'N/A' }}
            </td>

            <!-- Payment Details -->
            <td>
                <span class="label">Transaction ID:</span> {{ $booking->payment->payment_intent_id }}<br>
                <span class="label">Payment Status:</span>
                <span class="badge badge-{{ $booking->payment->status == 'succeeded' ? 'success' : 'warning' }}">
                    {{ ucfirst($booking->payment->status) }}
                </span><br>
                <span class="label">Payment Method:</span> {{ $booking->payment->payment_type ?? 'N/A' }}<br>
                @php
                    $total = $booking->payment->amount;
                    $percentage = $commission->percentage;
                    $commissionAmount = ($total * $percentage) / 100;
                    $hostAmount = $total - $commissionAmount;
                @endphp
                <span class="label">Total Amount:</span> ${{ number_format($booking->payment->amount, 2) }}<br>
                <span class="label">Booking Charge({{ $commission->percentage }}%):</span>
                ${{ number_format($commissionAmount, 2) }}<br>
                <span class="label">Host Payment: </span> ${{ number_format($hostAmount, 2) }}<br>

            </td>
        </tr>
    </table>

    <div class="footer">
        <p>Thank you for your booking!</p>
    </div>
</body>

</html>
