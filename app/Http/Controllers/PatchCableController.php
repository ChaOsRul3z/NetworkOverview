<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatchCableRequest;
use App\Models\PatchCable;
use App\Models\Unit;
use App\Models\Type;
use Illuminate\Http\Request;

class PatchCableController extends Controller
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
        $patchcables = PatchCable::with(['portA.vlans', 'portA.unit', 'portB.vlans', 'portB.unit'])->paginate(16);

        return view('patchcable.index', compact('patchcables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typesIds = Type::where('port_count', '>', '0')->select('id')->get()->toArray();
        $units = Unit::whereIn('type_id', $typesIds)->with('rack')->get();

        return view('patchcable.new', compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PatchCableRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatchCableRequest $request)
    {
        if ($request->ajax()) {
            if (Patchcable::where('portA_id', $request->portA_id)->orWhere('portB_id', $request->portB_id)->exists()) {
                return response()->json(['success' => true, 'created' => false, 'msg' => 'one or more ports is already connected.']);
            } else {
                PatchCable::create($request->all());
                \Cache::forget('patchcables');
                return response()->json(['success' => true, 'created' => true, 'msg' => 'patchcable created.']);
            }
        } else {
            PatchCable::create($request->all());
            \Cache::forget('patchcables');
            return redirect()->route('patchcables.index');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Patchcable $patchcable
     * @return \Illuminate\Http\Response
     */
    public function edit(Patchcable $patchcable)
    {
        $typesIds = Type::where('port_count', '>', '0')->select('id')->get()->toArray();
        $units = Unit::whereIn('type_id', $typesIds)->with('rack')->get();
        return view('patchcable.edit', compact('patchcable', 'units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PatchCableRequest $request
     * @param Patchcable $patchcable
     * @return \Illuminate\Http\Response
     */
    public function update(PatchCableRequest $request, Patchcable $patchcable)
    {
        $patchcable->update($request->all());

        return redirect()->route('patchcables.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PatchCable $patchCable
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(PatchCable $patchcable)
    {
        $patchcable->delete();

        return redirect()->route('patchcables.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PatchCable $patchcable
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroyById(PatchCable $patchcable)
    {
        $patchcable->delete();
        return response()->json(['success' => true, 'deleted' => true, 'msg' => 'patchcable successfully deleted.']);
    }
}
