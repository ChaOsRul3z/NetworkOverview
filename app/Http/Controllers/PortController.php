<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortRequest;
use App\Models\Port;
use App\Models\Unit;


class PortController extends Controller
{
    /**
     * PortController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'ajax']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function index(Unit $unit)
    {
        $ports = $unit->ports();

        return view('port.index', compact('unit', 'ports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('port.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Unit $unit
     * @param PortRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Unit $unit, PortRequest $request)
    {
        $unit->ports()->create($request->all());
        return redirect()->route('racks.units.edit', [$unit->rack, $unit]);
    }

    /**
     * Display the specified resource.
     *
     * @param Port $port
     * @return void
     */
    public function show(Port $port)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Unit $unit
     * @param Port $port
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit, Port $port)
    {
        return view('port.edit', compact('unit', 'port'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Unit $unit
     * @param Port $port
     * @param PortRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(Unit $unit, Port $port, PortRequest $request)
    {
        $port->update([
            'label' => $request->input('label'),
            'speed' => $request->input('speed'),
        ]);

        if (!empty($request->input('room'))) {
            $port->room()->sync([$request->input('room')]);
        }

        $rack = $unit->rack;

        return redirect()->route('racks.units.edit', compact('rack', 'unit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Unit $unit
     * @param Port $port
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Unit $unit, Port $port)
    {
        $port->delete();

        return redirect()->route('units.ports.index', compact('unit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Unit $unit
     * @return \Response::json
     */
    public function ajax(Unit $unit)
    {

        return \Response::json($unit->ports);
    }
}
