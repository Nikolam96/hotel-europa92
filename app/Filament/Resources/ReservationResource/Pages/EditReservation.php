<?php

namespace App\Filament\Resources\ReservationResource\Pages;

use App\Filament\Resources\ReservationResource;
use App\Mail\ReservationCanceled;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Mail;

class EditReservation extends EditRecord
{
    protected static string $resource = ReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function () {
                    $reservation = $this->record;

                    $reason = 'We are currently renovating this room. We sincerely apologize for the inconvenience and hope you find another suitable room in our hotel.';

                    Mail::to($reservation->email)->send(new ReservationCanceled($reservation, $reason));
                }),
        ];
    }
}
