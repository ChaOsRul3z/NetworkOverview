<?php

namespace App\Http\Controllers;

use App\Models\Room;

class RoomDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Room $room
     * @return \Illuminate\Http\Response
     */
    public function index(Room $room)
    {
        $devices = $room->devices();
        return view('room.device.index', compact('room', 'devices'));
    }
}
