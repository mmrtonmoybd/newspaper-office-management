<?php

namespace App\Http\Controllers\Ads\AdvertismentPanel;

use App\Http\Controllers\Controller;
use App\Models\AdvertismentPanel as Model;
use Illuminate\Http\Request;

class AdvertismentPanel extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.ads.adpanel.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.ads.adpanel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'org_name' => 'required|string',
            'advertisment_start_date' => 'required|date',
            'advertisment_end_date' => 'required|date',
            'amount' => 'required|numeric',
            'paid_date' => 'required|date',
            'comment' => 'required|string',
        ]);

        Model::create($request->all());

        return redirect()->route('backend.ads.panel.index')->with('growl', [
            'The data has been correctly added.',
            'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Model $panel)
    {
        return view('backend.ads.adpanel.view', [
            'panel' => $panel,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Model $panel)
    {
        return view('backend.ads.adpanel.edit', [
            'panel' => $panel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Model $panel)
    {

        $request->validate([
            'org_name' => 'required|string',
            'advertisment_start_date' => 'required|date',
            'advertisment_end_date' => 'required|date',
            'amount' => 'required|numeric',
            'paid_date' => 'required|date',
            'comment' => 'required|string',
            'created_at' => 'required|date',
        ]);

        $panel->update($request->all());

        return redirect()->route('backend.ads.panel.index')
            ->with('growl', ['The data has been correctly updated.', 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Model $panel)
    {
        return response()->json(['success' => $panel->delete() ?? false]);
    }
}
