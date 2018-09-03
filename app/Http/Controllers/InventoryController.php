<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Device::all();

        return view('inventory.index', compact('devices'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $name = $request->input('name');
        $date_from = $request->input('date-from');
        $date_to = $request->input('date-to');
        $types = $request->input('types');
        $rooms = $request->input('rooms');

        $devices = Device::
        when($types, function ($query) use ($types) {
            return $query->whereIn('type_id', $types);
        })
            ->when($rooms, function ($query) use ($rooms) {
                return $query->whereIn('room_id', $rooms);
            })
            ->when($name, function ($query) use ($name) {
                return $query->where('name', 'like', $name . '%');
            })
            ->when($date_from, function ($query) use ($date_from) {
                $date_from = Carbon::parse($date_from)->startOfDay();
                return $query->where('created_at', '>=', $date_from);
            })
            ->when($date_to, function ($query) use ($date_to) {
                $date_to = Carbon::parse($date_to)->endOfDay();
                return $query->where('created_at', '<=', $date_to);
            })
            ->get();

        return redirect()->route('inventory')->with('devices', $devices);
    }
}
