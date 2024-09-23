<?php

namespace App\Http\Controllers\Circulation;

use App\Http\Controllers\Controller;
use App\Models\DailyCirculation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DailyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.circulation.daily.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.circulation.daily.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'sell_quantity' => convertBengaliToEnglish($request->input('sell_quantity')),
            'per_price' => convertBengaliToEnglish($request->input('per_price')),
        ]);
        $request->validate([
            'sell_date' => 'nullable|date',
            'buyer_name' => 'required|string',
            'sell_quantity' => 'required|numeric',
            'per_price' => 'required|numeric',
        ]);

        DailyCirculation::create($request->all());

        return redirect()->route('backend.daily.index')->with('growl', [
            'The data has been correctly added.',
            'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyCirculation $daily)
    {
        return view('backend.circulation.daily.view', [
            'daily' => $daily,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DailyCirculation $daily)
    {
        Gate::authorize('update', [$daily->created_at, 'update_daily']);

        return view('backend.circulation.daily.edit', [
            'daily' => $daily,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DailyCirculation $daily)
    {
        Gate::authorize('update', [$daily->created_at, 'update_daily']);

        $request->merge([
            'sell_quantity' => convertBengaliToEnglish($request->input('sell_quantity')),
            'per_price' => convertBengaliToEnglish($request->input('per_price')),
        ]);
        $request->validate([
            'sell_date' => 'nullable|date',
            'buyer_name' => 'required|string',
            'sell_quantity' => 'required|numeric',
            'per_price' => 'required|numeric',
        ]);

        $daily->update($request->all());

        return redirect()->route('backend.daily.index')
            ->with('growl', ['The data has been correctly updated.', 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyCirculation $daily)
    {
        Gate::authorize('delete', [$daily->created_at, 'delete_daily']);

        return response()->json(['success' => $daily->delete() ?? false]);
    }
}
