<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Models\Rack;
use App\Models\Sort;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * TypeController constructor.
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
        return view('type.index', compact('sort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Sort $sort
     * @return \Illuminate\Http\Response
     */
    public function create(Sort $sort)
    {
        return view('type.new', compact('sort'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Sort $sort
     * @param TypeRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Sort $sort, TypeRequest $request)
    {
        $sort->types()->create($request->all());
        return redirect()->route('sorts.index')->with('success', 'type successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type) { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Sort $sort
     * @param Type $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Sort $sort, Type $type)
    {
        return view('type.edit', compact('sort', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Type $type
     * @param TypeRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Sort $sort, Type $type, TypeRequest $request)
    {
        $oldHeight = $type->unit_height;
        $newHeight = $request->input('unit_height');
        if ($oldHeight != $newHeight) {
            $racks = Rack::all();

            foreach ($racks as $rack) {
                $unitsOfTypeCount = $rack->units()->where('type_id', '=', $type->id)->get()->count();
                if ($oldHeight < $newHeight) {
                    $hightDiff = $newHeight - $oldHeight;
                    $rack->units_used += ($hightDiff * $unitsOfTypeCount);
                    $rack->save();
                } else {
                    $hightDiff = $oldHeight - $newHeight;
                    $rack->units_used -= ($hightDiff * $unitsOfTypeCount);
                    $rack->save();
                }
            }
        }

        $type->update($request->all());
        return redirect()->route('sorts.index')->with('success', 'type successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Sort $sort
     * @param Type $type
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Sort $sort, Type $type)
    {
        $type->delete();
        return redirect()->route('sorts.index')->with('success', 'type successfully deleted.');
    }
}
