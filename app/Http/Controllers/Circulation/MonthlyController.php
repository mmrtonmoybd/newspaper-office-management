<?php

namespace App\Http\Controllers\Circulation;

use App\Http\Controllers\Controller;
use App\Models\MonthlyCirculation;
use Illuminate\Http\Request;

class MonthlyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.circulation.monthly.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.circulation.monthly.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'monthly_circulation_repen_id' => 'required|numeric|exists:monthly_circulation_repens,id',
            'district' => 'required|string',
            'send_quantity' => 'required|numeric',
            'monthly_bill' => 'required|numeric',
            'paid_bill' => 'required|numeric',
            'paid_date' => 'required|date',
            'due_bill' => 'nullable|numeric',
            'comment' => 'nullable|string',
        ]);

        MonthlyCirculation::create($request->all());

        return redirect()->route('backend.monthly.index')->with('growl', [
            'The data has been correctly added.',
            'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MonthlyCirculation $monthly)
    {
        return view('backend.circulation.monthly.view', [
            'monthly' => $monthly
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MonthlyCirculation $monthly)
    {
        return view('backend.circulation.monthly.edit', [
            'monthly' => $monthly,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MonthlyCirculation $monthly)
    {
        $request->validate([
            'monthly_circulation_repen_id' => 'required|numeric|exists:monthly_circulation_repens,id',
            'district' => 'required|string',
            'send_quantity' => 'required|numeric',
            'monthly_bill' => 'required|numeric',
            'paid_bill' => 'required|numeric',
            'paid_date' => 'required|date',
            'due_bill' => 'nullable|numeric',
            'comment' => 'nullable|string',
        ]);

        $monthly->update($request->all());

        return redirect()->route('backend.monthly.index')
            ->with('growl', ['The data has been correctly updated.', 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MonthlyCirculation $monthly)
    {
        return response()->json(['success' => $monthly->delete() ?? false]);
    }
}
