<?php

namespace App\Services;

use App\Mail\HotelMail;
use App\Mail\ReservationMail;
use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Mail;

class ReservationService
{

    public function calculatePriceAndSave(array $reservation)
    {
        unset($reservation['g-recaptcha-response']);

        // Find room and validate
        $room = Room::findOrFail($reservation["room_id"]);
        $startDate = Carbon::parse($reservation['startDate']);
        $endDate = Carbon::parse($reservation['endDate']);

        if (!$room->isAvailable($room['id'], $startDate, $endDate)) {
            return false;
        }

        $createdReservation = $this->validateAndSave($reservation, $startDate, $endDate, $room);

        $this->sendMails($createdReservation, $room);

        return $createdReservation;
    }
    public function sendMails($reservation, $room)
    {

        Mail::to($reservation->email)->queue(new ReservationMail($room, $reservation));
        Mail::to('reservation@hotel92.com')->queue(new HotelMail($room, $reservation));
    }
    public function validateAndSave($reservation, $startDate, $endDate, $room)
    {
        // Calculate Price
        $daysDifference = max(1, $startDate->diffInDays($endDate));
        $reservation['price'] = $daysDifference * $room->price;

        // Save to datebase
        return Reservation::create($reservation);
    }

}
