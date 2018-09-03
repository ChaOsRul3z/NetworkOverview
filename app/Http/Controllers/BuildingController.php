<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuildingRequest;
use App\Models\Building;

class BuildingController extends Controller
{
    /**
     * BuildingController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildings = Building::all()->load('floors');

        return view('building.index', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('building.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BuildingRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuildingRequest $request)
    {
        $building = Building::create($request->all());

        return redirect()->route('buildings.show', compact('building'))->with('success', 'building successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param Building $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        $building = $building->load('floors');

        $floor = $building->floors()->first();

        return redirect()->route('buildings.floors.show', compact('building', 'floor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Building $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        return view('building.edit', compact('building'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Building $building
     * @param BuildingRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Building $building, BuildingRequest $request)
    {
        $building->update($request->all());

        return redirect()->route('buildings.show', compact('building'))->with('success', 'building successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Building $building
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Building $building)
    {
        $building->delete();

        return redirect()->route('buildings.index')->with('success', 'building successfully deleted.');
    }
}
