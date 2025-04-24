<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;

class ReservationService
{

    public function calculatePriceAndSave(array $reservation)
    {
        unset($reservation['g-recaptcha-response']);
        $room = Room::findOrFail($reservation["room_id"]);

        $startDate = Carbon::parse($reservation['startDate']);
        $endDate = Carbon::parse($reservation['endDate']);

        if (!$room->isAvailable($room['id'], $startDate, $endDate)) {
            return false;
        }

        // Calculate Price
        $daysDifference = $startDate->diffInDays($endDate);
        $reservation['price'] = $daysDifference * $room->price;

        // Save to datebase
        return [
            'reservation' => Reservation::create($reservation),
            'room' => $room,
        ];
    }

}
