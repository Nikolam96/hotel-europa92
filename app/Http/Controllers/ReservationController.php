<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservation;
use App\Models\Reservation;
use App\Models\Room;
use App\Services\ReservationService;
use Illuminate\Http\Request;

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
        $rooms = Room::select('name', 'price', 'id')->get();

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

        return redirect()->route('room.index')->with('success', 'Room reserved successfully.');

    }

}
