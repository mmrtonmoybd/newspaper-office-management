<?php

namespace App\Http\Controllers\Ads\Ass;

use App\Http\Controllers\Controller;
use App\Models\AdAs;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdsAsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.ads.as.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.ads.as.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'details' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'published_date' => 'required|date',
            'amount' => 'required|numeric',
            'size' => 'required|string|max:255',
            'page' => 'required|string',
            'as' => 'required|string',
            'comment' => 'required|string',
        ]);

        AdAs::create($request->all());

        return redirect()->route('backend.ads.as.index')->with('growl', [
            'The data has been correctly added.',
            'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AdAs $a)
    {
        return view('backend.ads.as.view', [
            'adas' => $a,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdAs $a)
    {
        return view('backend.ads.as.edit', [
            'adas' => $a,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdAs $a)
    {
        $request->validate([
            'details' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'published_date' => 'required|date',
            'amount' => 'required|numeric',
            'size' => 'required|string|max:255',
            'page' => 'required|string',
            'as' => 'required|string',
            'comment' => 'required|string',
            'created_at' => 'required|date',
        ]);

        $a->update($request->all());

        return redirect()->route('backend.ads.as.index')
            ->with('growl', ['The data has been correctly updated.', 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdAs $a): JsonResponse
    {
        return response()->json(['success' => $a->delete() ?? false]);
    }
}
