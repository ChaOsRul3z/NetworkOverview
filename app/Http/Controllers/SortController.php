<?php

namespace App\Http\Controllers;

use App\Http\Requests\SortRequest;
use App\Models\Sort;
use Illuminate\Http\Request;

class SortController extends Controller
{
    /**
     * SortController constructor.
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
        $sorts = Sort::all();

        return view('sort.index', compact('sorts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sort.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SortRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SortRequest $request)
    {
        Sort::create($request->all());
        return redirect()->route('sorts.index')->with('success', 'sort successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param Sort $sort
     * @return void
     */
    public function show(Sort $sort) { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Sort $sort
     * @return \Illuminate\Http\Response
     */
    public function edit(Sort $sort)
    {
        return view('sort.edit', compact('sort'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Sort $sort
     * @param SortRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Sort $sort, SortRequest $request)
    {
        $sort->update($request->all());
        return redirect()->route('sorts.index')->with('success', 'sort successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Sort $sort
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Sort $sort)
    {
        $sort->delete();
        return redirect()->route('sorts.index')
            ->with('success', 'sort successfully deleted.');
    }
}
