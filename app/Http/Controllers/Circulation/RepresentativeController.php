<?php

namespace App\Http\Controllers\Circulation;

use App\Http\Controllers\Controller;
use App\Models\MonthlyCirculationRepen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RepresentativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.circulation.representative.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.circulation.representative.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:monthly_circulation_repens,email',
            'mobile' => 'nullable|string|unique:monthly_circulation_repens,mobile',
        ]);

        MonthlyCirculationRepen::create($request->all());

        return redirect()->route('backend.representative.index')->with('growl', [
            'The data has been correctly added.',
            'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MonthlyCirculationRepen $representative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MonthlyCirculationRepen $representative)
    {
        Gate::authorize('update', [$representative->created_at, 'update_representative']);

        return view('backend.circulation.representative.edit', [
            'representative' => $representative,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MonthlyCirculationRepen $representative)
    {
        Gate::authorize('update', [$representative->created_at, 'update_representative']);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:monthly_circulation_repens,email,'.$representative->id,
            'mobile' => 'nullable|string|unique:monthly_circulation_repens,mobile,'.$representative->id,
        ]);

        $representative->update($request->all());

        return redirect()->route('backend.representative.index')
            ->with('growl', ['The data has been correctly updated.', 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MonthlyCirculationRepen $representative)
    {
        Gate::authorize('delete', [$representative->created_at, 'delete_representative']);

        return response()->json(['success' => $representative->delete() ?? false]);
    }
}
