<?php

use App\Models\Room;

class UpdatePriceService
{
    static function handle($set, $get)
    {
        $roomId = $get('room_id');
        $startDate = $get('startDate');
        $endDate = $get('endDate');

        if ($roomId && $startDate && $endDate) {
            $room = Room::find($roomId);

            if ($room) {
                $start = \Carbon\Carbon::parse($startDate);
                $end = \Carbon\Carbon::parse($endDate);

                $days = $start->diffInDays($end);
                $days = max($days, 1);

                $totalPrice = round($days * $room->price, 2);

                $set('price', $totalPrice);
            }
        }
    }
}
