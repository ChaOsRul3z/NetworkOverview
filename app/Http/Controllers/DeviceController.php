<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceRequest;
use App\Models\Device;

class DeviceController extends Controller
{
    /**
     * DeviceController constructor.
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
        $devices = Device::paginate(18);

        return view('device.index', compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('device.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DeviceRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeviceRequest $request)
    {
        Device::create($request->all());

        return redirect()->route('devices.index')->with('success', 'device successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param Device $device
     * @return void
     */
    public function show(Device $device)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Device $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        return view('device.edit', compact('device'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DeviceRequest $request
     * @param Device $device
     * @return \Illuminate\Http\Response
     */
    public function update(Device $device, DeviceRequest $request)
    {
        $device->update($request->input());

        $device->properties()->detach();

        if (!is_null($request->input('property_ids'))) {
            $property_values = $request->input('property_values');
            foreach ($request->input('property_ids') as $index => $value) {
                $property[$value] = ["value" => $property_values[$index]];
                if (trim($property_values[$index]) === "") {
                    continue;
                }
                $device->properties()->attach($property);
            }
        }
        return redirect()->route('devices.index')->with('success', 'device successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Device $device
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Device $device)
    {
        if ($device->delete()) {
            return redirect()->route('devices.index')->with('success', 'device successfully deleted.');
        }
        return redirect()->route('devices.index')->with('error', 'couldn\'t delete device successfully.');
    }
}
