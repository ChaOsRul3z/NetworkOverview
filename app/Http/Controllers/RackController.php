<?php

namespace App\Http\Controllers;

use App\Http\Requests\RackRequest;
use App\Models\Rack;
use App\Models\Room;
use App\Models\Type;
use App\Models\PatchCable;
use App\Models\Vlan;

class RackController extends Controller
{
    /**
     * RackController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Room $room
     * @return \Illuminate\Http\Response
     */
    public function index(Room $room)
    {
        $racks = Rack::all()->load('units');

        $types = Type::all()->load('sort');

        $patchcables = PatchCable::all()->load('portA.unit', 'portA.vlans')->load('portB.unit', 'portB.vlans');

        return view('rack.index', compact('room', 'racks', 'patchcables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Room $room
     * @return \Illuminate\Http\Response
     */
    public function create(Room $room)
    {
        return view('rack.new', compact('room'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Room $room
     * @param RackRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Room $room, RackRequest $request)
    {
        $rack = $room->racks()->create($request->all());

        return redirect()->route('rooms.racks.show', compact('room', 'rack'))->with('success', 'rack successfully created.');;
    }

    /**
     * Display the specified resource.
     *
     * @param Room $room
     * @param Rack $rack
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Room $room, Rack $rack)
    {
        if ($rack->room != $room) {
            $rack = $room->racks->first();
            return redirect()->route('rooms.racks.show', compact('room', 'rack'));
        }

        $rack->load('units.properties', 'units.type.sort', 'units.ports');

        $ports = collect();

        foreach ($rack->units as $unit) {
            foreach ($unit->ports as $port) {
                $ports->push($port->id);
            }
        }

        $patchcables = PatchCable::whereIn('portA_id', $ports)->orWhereIn('portB_id', $ports)->get()
                ->load('portA.unit', 'portA.vlans')->load('portB.unit', 'portB.vlans');

        $vlans = Vlan::all();

        return view('rack.show', compact('room', 'rack', 'patchcables', 'vlans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Room $room
     * @param Rack $rack
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room, Rack $rack)
    {
        return view('rack.edit', compact('room', 'rack'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Room $room
     * @param RackRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Room $room, Rack $rack, RackRequest $request)
    {
        $rack->update($request->all());

        return redirect()->route('floors.rooms.show', [$room->floor, $room])->with('success', 'rack successfully updated.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Room $room
     * @param Rack $rack
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @internal param Room $room
     */
    public function destroy(Room $room, Rack $rack)
    {
        $rack->delete();

        return redirect()->route('floors.rooms.show', [$room->floor, $room])->with('success', 'rack successfully deleted.');;
    }
}
