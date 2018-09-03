<?php

namespace App\Http\Controllers;

use App\Http\Requests\VlanRequest;
use App\Models\Vlan;

class VlanController extends Controller
{
    /**
     * UnitController constructor.
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
        $vlans = Vlan::all();

        return view('vlan.index', compact('vlans'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vlan.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VlanRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VlanRequest $request)
    {
        Vlan::create($request->all());

        return redirect()->route('vlans.index')->with('success', 'vlan successfully created.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Vlan $vlan
     * @return \Illuminate\Http\Response
     */
    public function edit(Vlan $vlan)
    {
        return view('vlan.edit', compact('vlan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VlanRequest $request
     * @param Vlan $vlan
     * @return \Illuminate\Http\Response
     */
    public function update(VlanRequest $request, Vlan $vlan)
    {
        $vlan->update($request->all());

        return redirect()->route('vlans.index')->with('success', 'vlan successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Vlan $vlan
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Vlan $vlan)
    {
      $vlan->delete();
      
      return redirect()->route('vlans.index')->with('success', 'vlan successfully deleted.');
    }
}
