<?php

namespace App\Http\Controllers\Press;

use App\Http\Controllers\Controller;
use App\Models\PressInk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PressInkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.press.ink.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.press.ink.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'color' => 'required|string',
            'purchased_date' => 'required|date',
            'amount' => 'required|numeric',
            'quantity' => 'required|string',
        ]);

        PressInk::create($request->all());

        return redirect()->route('backend.ink.index')->with('growl', [
            'The data has been correctly added.',
            'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PressInk $ink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PressInk $ink)
    {
        Gate::authorize('update', [$ink->created_at, 'update_ink']);

        return view('backend.press.ink.edit', [
            'ink' => $ink,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PressInk $ink)
    {
        Gate::authorize('update', [$ink->created_at, 'update_ink']);
        $request->validate([
            'color' => 'required|string',
            'purchased_date' => 'required|date',
            'amount' => 'required|numeric',
            'quantity' => 'required|string',
        ]);

        $ink->update($request->all());

        return redirect()->route('backend.ink.index')
            ->with('growl', ['The data has been correctly updated.', 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PressInk $ink)
    {
        Gate::authorize('delete', [$ink->created_at, 'delete_ink']);

        return response()->json(['success' => $ink->delete() ?? false]);
    }
}
