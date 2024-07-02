<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FieldRequest;
use App\Http\Resources\FieldResource;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index()
    {
        $fields = Field::all();
        $fields = FieldResource::collection($fields);
        return view('setting.fields.index', compact('fields'));
    }

    public function create()
    {
        $fields = Field::all();
        return view('setting.fields.create', compact('fields'));
    }

    public function store(FieldRequest $request)
{
    $validated = $request->validated();
    $field = Field::create($validated);

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
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric|min:0',
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
