<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $upsetting = Setting::where('name', 'update_within')->firstOrFail();
        $delsetting = Setting::where('name', 'delete_within')->firstOrFail();

        return view('backend.settings.edit', [
            'update' => $upsetting,
            'delete' => $delsetting,
        ]);
    }

    public function update(Request $request)
    {

        $request->validate([
            'update_within' => 'required|numeric',
            'delete_within' => 'required|numeric',
        ]);

        Setting::where('name', 'update_within')->update([
            'value' => $request->input('update_within'),
        ]);

        Setting::where('name', 'delete_within')->update([
            'value' => $request->input('delete_within'),
        ]);

        return redirect()->route('backend.settings.index')
            ->with('growl', ['The data has been correctly updated.', 'success']);
    }
}
