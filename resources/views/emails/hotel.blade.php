<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reservation Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            color: #333;
            padding: 20px;
        }

        .container {
            background: #fff;
            border-radius: 8px;
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .details {
            margin-bottom: 20px;
        }

        .details p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">New Reservation✅</div>

        <div class="details">
            <p><strong>Room:</strong> {{ $room->name }}</p>
            <p><strong>Email:</strong> {{ $reservation->email }}</p>
            <p><strong>Phone:</strong> {{ $reservation->phone }}</p>
            @if (isset($reservation->note))
                <p><strong>Note:</strong> {{ $reservation->note }}</p>
            @endif
            <p><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($reservation->startDate)->format('F j, Y') }}</p>
            <p><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($reservation->endDate)->format('F j, Y') }}</p>
            <p><strong>Nights:</strong>
                {{ \Carbon\Carbon::parse($reservation->startDate)->diffInDays($reservation->endDate) }}</p>
            <p><strong>Total Price:</strong> ${{ number_format($reservation->price, 2) }}</p>
        </div>
    </div>
</body>

</html>
