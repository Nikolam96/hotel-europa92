<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
    public function isAvailable($room, $startDate, $endDate)
    {
        return !$this->reservations()
            ->where("room_id", '=', $room)
            ->where('startDate', '<', $endDate)
            ->where('endDate', '>', $startDate)
            ->exists();
    }
}
