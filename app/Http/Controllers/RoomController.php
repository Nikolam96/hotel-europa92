<?php

namespace App\Http\Controllers;

use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::select('name', 'price', 'short_description', 'image', 'id')->paginate(6);

        return view('room.index', compact('rooms'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('room.show', compact('room'));
    }
}
