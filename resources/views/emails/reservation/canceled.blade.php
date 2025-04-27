<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reservation Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            color: black;
            padding: 20px;
            margin-top: 20px
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
            color: red
        }

        .details {
            margin-bottom: 20px;
            color: black
        }

        .details p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header"> Reservation Canceled</div>

        <div class="details">
            <h2>The reservation for room **{{ $reservation->room->name }}** has been canceled.</h2>
            **Reason:**
            {{ $reason }}

            Thanks,
            Hotel-europa92
        </div>
    </div>
</body>

</html>
