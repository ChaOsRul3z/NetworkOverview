<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyRequest;
use App\Models\Property;

class PropertyController extends Controller
{
    /**
     * PropertyController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::all();

        return view('property.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('property.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PropertyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        Property::create($request->all());
        return redirect()->route('properties.index')->with('success', 'property successfully created.');;
    }

    /**
     * Display the specified resource.
     *
     * @param Property $property
     * @return void
     */
    public function show(Property $property)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Property $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        return view('property.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PropertyRequest $request
     * @param Property $property
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, Property $property)
    {
        $property->update($request->all());

        return redirect()->route('properties.index')
            ->with('success', 'property successfully updated.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Property $property
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'property successfully deleted.');;
    }
}
