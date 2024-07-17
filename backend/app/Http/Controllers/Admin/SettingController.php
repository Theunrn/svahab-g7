<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;

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
        $settings = Setting::all();
        return view('setting.settings.index', compact('settings'));
    }

    public function show()
    {
        $user = auth()->user();
        return view('setting.settings.index', compact('user'));
    }

    /**
     * Show the form for creating a new setting.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created setting in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation can be added here if needed

        $setting = new Setting();
        $setting->key = $request->input('key');
        $setting->value = $request->input('value');
        $setting->email_address = $request->input('email_address');
        $setting->responsible = $request->input('responsible');
        $setting->email_notifications = $request->input('email_notifications', 0); // Assuming default is disabled

        $setting->save();

        return redirect()->route('settings.index')
            ->with('success', 'Setting created successfully.');
    }


    /**
     * Show the form for editing the specified setting.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $setting = Setting::findOrFail($id); // Assuming Setting is your model

        return view('settings.edit', compact('setting'));
    }

    /**
     * Remove the specified setting from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $setting = Setting::findOrFail($id); // Assuming Setting is your model
        $setting->delete();

        return redirect()->route('settings.index')
            ->with('success', 'Setting deleted successfully.');
    }
}
