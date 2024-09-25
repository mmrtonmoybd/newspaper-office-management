<?php

namespace App\Http\Controllers\Press;

use App\Http\Controllers\Controller;
use App\Models\PressPaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
        $request->merge([
            'published_order' => convertBengaliToEnglish($request->input('published_order')),
            'wastage' => convertBengaliToEnglish($request->input('wastage')),
        ]);
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
        return view('backend.press.paper.view', [
            'paper' => $paper
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PressPaper $paper)
    {
        Gate::authorize('update', [$paper->created_at, 'update_paper']);

        return view('backend.press.paper.edit', [
            'paper' => $paper,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PressPaper $paper)
    {
        Gate::authorize('update', [$paper->created_at, 'update_paper']);
        $request->merge([
            'published_order' => convertBengaliToEnglish($request->input('published_order')),
            'wastage' => convertBengaliToEnglish($request->input('wastage')),
        ]);
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
        Gate::authorize('delete', [$paper->created_at, 'delete_paper']);

        return response()->json(['success' => $paper->delete() ?? false]);
    }
}
