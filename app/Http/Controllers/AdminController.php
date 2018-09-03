<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Property;
use App\Models\Rack;
use App\Models\Sort;
use App\Models\Vlan;

class AdminController extends Controller
{
    /**
     * Displays the index page of the admin panel
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function showVlans()
    {
        $vlans = Vlan::all();

        return view('admin.vlans', compact('vlans'));
    }

    public function showSorts()
    {
        $sorts = Sort::with('types')->get();

        return view('admin.sorts', compact('sorts'));
    }

    public function showPatchCables()
    {
        return view('admin.patchcables');
    }

    public function showProperties()
    {
        $properties = Property::all();
        return view('admin.properties', compact('properties'));
    }

    public function showDevices() {
        $devices = Device::all();
        return view('admin.devices', compact('devices'));
    }
}
