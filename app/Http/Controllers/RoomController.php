<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Floor;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * RoomController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Floor $floor
     * @return \Illuminate\Http\Response
     */
    public function index(Floor $floor)
    {
        $rooms = $floor->rooms;

        if ($rooms->count()) {
            $room = $rooms->first();

            return redirect()->route('floors.rooms.show', compact('floor', 'room'));
        }

        return view('room.index', compact('floor'));

        $floor->load('rooms.racks');
        $cache_key = "floor_{$floor->id}";

        $floor = \Cache::remember($cache_key, 60, function () use ($floor) {
            return $floor->load('rooms.racks');
        });

        $room = $floor->rooms->first();

        return redirect()->route('floors.rooms.show', compact('floor', 'room'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Floor $floor
     * @return \Illuminate\Http\Response
     */
    public function create(Floor $floor)
    {
        return view('room.new', compact('floor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Floor $floor
     * @param RoomRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Floor $floor, RoomRequest $request)
    {
        // create room
        $room = $floor->rooms()->create($request->all());

        // room cache key
        $cache_key = "room_{$room->id}";

        // store room in cache
        $room = \Cache::remember($cache_key, 60, function () use ($room) {
            return $room->load('racks.units');
        });

        return redirect()->route('floors.rooms.show', compact('floor', 'room'))
            ->with('success', 'Room successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param Floor $floor
     * @param Room $room
     * @return \Illuminate\Http\Response
     */
    public function show(Floor $floor, Room $room)
    {
        if ($room->devices->count()) {
            return redirect()->route('rooms.devices.index', compact('room'));
        }

        if ($room->racks->count()) {
            $rack = $room->racks->first();
            return redirect()->route('rooms.racks.show', compact('room', 'rack'));
        }

        if ($room->floor != $floor) {
            $floor = $room->floor;
            return redirect()->route('floors.rooms.show', compact('floor', 'room'));
        }

        return view('room.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Floor $floor
     * @param Room $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Floor $floor, Room $room)
    {
        return view('room.edit', compact('floor', 'room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Floor $floor
     * @param Room $room
     * @param RoomRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Floor $floor, Room $room, RoomRequest $request)
    {
        $room->update($request->all());

        return redirect()->route('floors.rooms.show', compact('floor', 'room'))
            ->with('success', 'room successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Floor $floor
     * @param Room $room
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Floor $floor, Room $room)
    {
        $room->delete();

        $building = $floor->building;

        return redirect()->route('buildings.floors.show', compact('building', 'floor'))
            ->with('success', 'device successfully deleted.');
    }
}
