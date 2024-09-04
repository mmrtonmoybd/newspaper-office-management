<?php

namespace App\Http\Controllers\Ads\An;

use App\Http\Controllers\Controller;
use App\Models\AdAn;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdsAnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.ads.an.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.ads.an.create');
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
            'an' => 'required|string',
            'comment' => 'required|string',
        ]);

        AdAn::create($request->all());

        return redirect()->route('backend.ads.an.index')->with('growl', [
            'The data has been correctly added.',
            'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AdAn $an)
    {
        return view('backend.ads.an.view', [
            'adan' => $an,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdAn $an)
    {
        return view('backend.ads.an.edit', [
            'adan' => $an,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdAn $an)
    {
        $request->validate([
            'details' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'published_date' => 'required|date',
            'amount' => 'required|numeric',
            'size' => 'required|string|max:255',
            'page' => 'required|string',
            'an' => 'required|string',
            'comment' => 'required|string',
            'created_at' => 'required|date',
        ]);

        $an->update($request->all());

        return redirect()->route('backend.ads.an.index')
            ->with('growl', ['The data has been correctly updated.', 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdAn $an): JsonResponse
    {
        return response()->json(['success' => $an->delete() ?? false]);
    }
}
