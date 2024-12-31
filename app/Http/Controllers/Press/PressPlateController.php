<?php

namespace App\Http\Controllers\Press;

use App\Http\Controllers\Controller;
use App\Models\PressPlate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PressPlateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.press.plate.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.press.plate.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'advance_paid' => convertBengaliToEnglish($request->input('advance_paid')),
            'cut_amount' => convertBengaliToEnglish($request->input('cut_amount')),
            'daily_plate' => convertBengaliToEnglish($request->input('daily_plate')),
            'new_plate' => convertBengaliToEnglish($request->input('new_plate')),
        ]);
        $plate = PressPlate::create($request->all());
        $lastid = $plate->id;

        $total = $request->new_plate - $request->daily_plate;

        $previous = PressPlate::where('id', '<', $lastid)->orderBy('id', 'desc')->first();

        // dd($total, $lastid, $previous);

        if ($previous) {
            $total = ($previous->total_plate + $request->new_plate) - $request->daily_plate;
        }

        $curplate = PressPlate::find($lastid);
        $curplate->total_plate = $total;
        $curplate->save();

        return redirect()->route('backend.plate.index')->with('growl', [
            'The data has been correctly added.',
            'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PressPlate $plate)
    {
        return view('backend.press.plate.view', [
            'plate' => $plate,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PressPlate $plate)
    {
        Gate::authorize('update', [$plate->created_at, 'update_plate']);

        return view('backend.press.plate.edit', [
            'plate' => $plate,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PressPlate $plate)
    {
        Gate::authorize('update', [$plate->created_at, 'update_plate']);

        $request->merge([
            'advance_paid' => convertBengaliToEnglish($request->input('advance_paid')),
            'cut_amount' => convertBengaliToEnglish($request->input('cut_amount')),
            'daily_plate' => convertBengaliToEnglish($request->input('daily_plate')),
            'new_plate' => convertBengaliToEnglish($request->input('new_plate')),
        ]);
        $plate->update($request->all());

        $lastid = $plate->id;

        $total = $request->new_plate - $request->daily_plate;

        $previous = PressPlate::where('id', '<', $lastid)->orderBy('id', 'desc')->first();

        if ($previous) {
            $total = ($previous->total_plate + $request->new_plate) - $request->daily_plate;
        }

        $curplate = PressPlate::find($lastid);
        $curplate->total_plate = $total;
        $curplate->save();

        // if have any next data

        $nextdata = PressPlate::where('id', '>', $plate->id)->orderBy('id', 'asc')->get();

        // dd($nextdata);

        if ($nextdata) {
            foreach ($nextdata as $key => $value) {
                $previous2 = PressPlate::where('id', '<', $value->id)->orderBy('id', 'desc')->first();
                $curplate2 = PressPlate::find($value->id);
                $curplate2->total_plate = ($previous2->total_plate + $curplate2->new_plate) - $curplate2->daily_plate;

                // dd($previous2, $curplate2);
                $curplate2->save();

            }
        }

        return redirect()->route('backend.plate.index')
            ->with('growl', ['The data has been correctly updated.', 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PressPlate $plate)
    {
        Gate::authorize('delete', [$plate->created_at, 'delete_plate']);
        $id = $plate->id;

        $plate->delete();

        $previousPlate = PressPlate::where('id', '<', $id)->orderBy('id', 'desc')->first();

        $nextdata = PressPlate::where('id', '>', $id)->orderBy('id', 'asc')->get();

        if ($nextdata) {
            foreach ($nextdata as $key => $value) {
                $previous2 = PressPlate::where('id', '<', $value->id)->orderBy('id', 'desc')->first();
                $curplate2 = PressPlate::find($value->id);

                if (PressPlate::where('id', '<', $curplate2->id)->orderBy('id', 'desc')->count() > 0) {
                    $curplate2->total_plate = ($previous2->total_plate + $curplate2->new_plate) - $curplate2->daily_plate;

                } else {
                    $cal = $curplate2->new_plate - $curplate2->daily_plate;
                    $curplate2->total_plate = ($cal > 0) ? $cal : 0;
                }

                // dd($nextdata, $previous2, $curplate2);
                $curplate2->save();

                // dd($previous2, $curplate2);
            }
        }

        return response()->json(['success' => true]);
    }

    public function delete(PressPlate $plate)
    {
        $id = $plate->id;

        // $plate->delete();

        $previousPlate = PressPlate::where('id', '<', $id)->orderBy('id', 'desc')->first();

        $nextdata = PressPlate::where('id', '>', $id)->orderBy('id', 'asc')->get();

        if ($nextdata) {
            foreach ($nextdata as $key => $value) {
                $previous2 = PressPlate::where('id', '<', $value->id)->orderBy('id', 'desc')->first();
                $curplate2 = PressPlate::find($value->id);

                if (PressPlate::where('id', '<', $curplate2->id)->orderBy('id', 'desc')->count() > 0) {
                    $curplate2->total_plate = ($previous2->total_plate + $curplate2->new_plate) - $curplate2->daily_plate;

                } else {
                    $cal = $curplate2->new_plate - $curplate2->daily_plate;
                    $curplate2->total_plate = ($cal > 0) ? $cal : 0;
                }

                // dd($nextdata, $previous2, $curplate2);
                $curplate2->save();

                // dd($previous2, $curplate2);
            }
        }

        // dd($nextdata);

        // return response()->json(['success' => $paper->delete() ?? false]);
    }
}
