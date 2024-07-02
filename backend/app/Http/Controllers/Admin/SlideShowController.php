<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\API\SlideShowController as APISlideShowController;
use App\Http\Controllers\Controller;
use App\Models\SlideShow;
use Illuminate\Http\Request;

class SlideShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slideshow = SlideShow::all();
        return view('setting.slideshow.index', compact('slideshow'));
    }

    public function create()
    {
        return view('setting.fields.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'field_type' => 'required|string|max:255',
            'owner_id' => 'required|integer',
            'availablity' => 'required|boolean',
        ]);

        Field::create($request->all());

        return redirect()->route('admin.fields.index')->with('success', 'Field created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $field = Field::find($id);
        return view('setting.fields.edit', compact('field'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'field_type' => 'required|string|max:255',
            'owner_id' => 'required|integer',
            'availablity' => 'required|boolean',
        ]);

        $field = Field::findOrFail($id);
        $field->update($request->all());

        return redirect()->route('admin.fields.index')->with('success', 'Field updated successfully.');
    }


    public function destroy($id)
    {
        $field = Field::findOrFail($id);
        $field->delete();

        return redirect()->route('admin.fields.index')->with('success', 'Field deleted successfully.');
    }
}
