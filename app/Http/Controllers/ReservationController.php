<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservation;
use App\Mail\HotelMail;
use App\Mail\ReservationMail;
use App\Models\Reservation;
use App\Models\Room;
use App\Services\ReservationService;
use Illuminate\Http\Request;
use Mail;

class ReservationController extends Controller
{

    public function __construct(public ReservationService $reservation)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservation = Reservation::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $rooms = Room::all();

        if ($request->id) {
            $selected = $request->id;
            return view("reservation.create", compact("rooms", "selected"));
        }

        return view("reservation.create", compact("rooms"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservation $request)
    {
        $data = $request->validated();
        $response = $this->reservation->calculatePriceAndSave($data);
        if (!$response) {
            return back()->withErrors(['reservation' => 'This room is not available for the selected dates.']);
        }
        Mail::to($response['reservation']->email)->queue(new ReservationMail($response['room'], $response['reservation']));
        Mail::to('reservation@hotel92.com')->queue(new HotelMail($response['room'], $response['reservation']));
        return redirect()->route('room.index')->with('success', 'Room reserved successfully.');
        ;
    }

}
