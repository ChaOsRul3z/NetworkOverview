<?php

namespace App\Http\Controllers;

use App\Http\Requests\FloorRequest;
use App\Models\Building;
use App\Models\Floor;

class FloorController extends Controller
{
    /**
     * FloorController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Building $building
     * @return \Illuminate\Http\Response
     */
    public function index(Building $building)
    {
        $floors = $building->floors->load('rooms.racks');

        return view('floor.index', compact('building', 'floors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Building $building
     * @return \Illuminate\Http\Response
     */
    public function create(Building $building)
    {
        return view('floor.new', compact('building'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Building $building
     * @param FloorRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Building $building, FloorRequest $request)
    {
        $floor = $building->floors()->create($request->all());

        return redirect()->route('buildings.floors.show', compact('building', 'floor'))
            ->with('success', 'floor successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param Building $building
     * @param Floor $floor
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building, Floor $floor)
    {
        if ($floor->building != $building) {
            $floor = $building->floors->first();
            return redirect()->route('buildings.floors.show', compact('building', 'floor'));
        }

        return view('floor.show', compact('building', 'floor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Building $building
     * @param Floor $floor
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building, Floor $floor)
    {
        return view('floor.edit', compact('building', 'floor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Building $building
     * @param Floor $floor
     * @param FloorRequest $request
     * @return \Illuminate\Http\Response
     * @internal param Building $building
     */
    public function update(Building $building, Floor $floor, FloorRequest $request)
    {
        $floor->update($request->all());

        $floor->load('rooms.racks');

        return redirect()->route('buildings.floors.show', compact('building', 'floor'))
            ->with('success', 'floor successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Building $building
     * @param Floor $floor
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Building $building, Floor $floor)
    {
        $floor->delete();

        return redirect()->route('buildings.show', compact('building'))
            ->with('success', 'floor successfully deleted.');
    }
}
