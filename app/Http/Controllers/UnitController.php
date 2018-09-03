<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Http\Requests\UnitSortRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Models\Property;
use App\Models\Rack;
use App\Models\Type;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * UnitController constructor.
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
    public function index() { }

    /**
     * Show the form for creating a new resource.
     *
     * @param Rack $rack
     * @return \Illuminate\Http\Response
     */
    public function create(Rack $rack)
    {
        $types = Type::all();
        $properties = Property::all();

        return view('unit.new', compact('rack', 'types', 'properties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Rack $rack
     * @param UnitRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Rack $rack, UnitRequest $request)
    {
        $type = Type::find($request->input('type_id'));

        $rack->update([
            'units_used' => $rack->units_used + $type->unit_height
        ]);

        $rack->units()->create($request->all());

        return redirect()->route('floors.rooms.show', [$rack->room->floor, $rack->room])->with('success', 'unit successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param Rack $rack
     * @return \Illuminate\Http\Response
     */
    public function show(Rack $rack) { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Rack $rack
     * @param Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Rack $rack, Unit $unit)
    {
        $types = Type::all();
        $properties = Property::all();
        return view('unit.edit', compact('rack', 'unit', 'types', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Rack $rack
     * @param Unit $unit
     * @param UpdateUnitRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Rack $rack, Unit $unit, UpdateUnitRequest $request)
    {
        $unit->update($request->all());

        $unit->properties()->detach();

        if (!is_null($request->input('property_ids'))) {
            $property_values = $request->input('property_values');
            foreach ($request->input('property_ids') as $index => $value) {
                $property[$value] = ["value" => $property_values[$index]];
                if (trim($property_values[$index]) === "") {
                    continue;
                }
                $unit->properties()->attach($property);
            }
        }

        return redirect()->route('floors.rooms.show', [$rack->room->floor, $rack->room])
            ->with('success', 'unit successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Rack $rack
     * @param Unit $unit
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Rack $rack, Unit $unit)
    {
        $rack->update([
            'units_used' => $rack->units_used - $unit->type->unit_height
        ]);

        $unit->delete();

        return redirect()->route('floors.rooms.show', [$rack->room->floor, $rack->room])
            ->with('success', 'unit successfully deleted.');
    }
}
