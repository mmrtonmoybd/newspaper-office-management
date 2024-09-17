<?php

namespace App\Http\Controllers\Press;

use App\Models\PressPaper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PressPaperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.press.paper.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.press.paper.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'roll' => 'required|string',
            'roll_weight' => 'required|string',
            'published_order' => 'required|numeric',
            'wastage' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $total = $request->input('published_order') + $request->input('wastage');
        $request->request->add(['total' => $total]);

        //dd($total, $request);

        PressPaper::create($request->all());

        return redirect()->route('backend.paper.index')->with('growl', [
            'The data has been correctly added.',
            'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PressPaper $paper)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PressPaper $paper)
    {
        return view('backend.press.paper.edit', [
            'paper' => $paper
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PressPaper $paper)
    {
        $request->validate([
            'roll' => 'required|string',
            'roll_weight' => 'required|string',
            'published_order' => 'required|numeric',
            'wastage' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $total = $request->input('published_order') + $request->input('wastage');
        $request->request->add(['total' => $total]);

        $paper->update($request->all());

        return redirect()->route('backend.paper.index')
            ->with('growl', ['The data has been correctly updated.', 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PressPaper $paper)
    {
        return response()->json(['success' => $paper->delete() ?? false]);
    }
}
