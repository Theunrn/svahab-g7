<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::all();
        return view('setting.setting.mail', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function edit($id)
    {
        $setting = Setting::find($id);
        return view('setting.setting.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'key' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'email_address' => 'required|email',
            'responsible' => 'required|string|max:255',
            'email_notifications' => 'required|boolean',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'timezone' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:10',
            'currency' => 'nullable|string|max:10',
            'date_format' => 'nullable|string|max:10',
            'time_format' => 'nullable|string|max:10',
            'maintenance_mode' => 'nullable|boolean',
            'additional_data' => 'nullable|json',
        ]);

        $setting = Setting::find($id);
        $setting->update($request->all());

        return redirect()->route('setting.setting.index')->with('success', 'Settings updated successfully');
    }
}
