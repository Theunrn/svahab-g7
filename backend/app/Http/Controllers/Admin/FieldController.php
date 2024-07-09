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
        $fields = auth()->user()->isAdmin() ? Field::all() : auth()->user()->fields;
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
        
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $validated['image'] = 'images/' . $imageName;
        }
        
        Field::create($validated);
        
        return redirect()->route('admin.fields.index')->with('success', 'Field created successfully.');
    }

    public function edit($id)
    {
        $field = Field::findOrFail($id);
        return view('setting.fields.edit', compact('field'));
    }

    public function update(FieldRequest $request, Field $field)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $validated['image'] = 'images/' . $imageName;
        }

        $field->update($validated);

        return redirect()->route('admin.fields.index')->with('success', 'Field updated successfully.');
    }

    public function destroy($id)
    {
        $field = Field::findOrFail($id);
        $field->delete();

        return redirect()->route('admin.fields.index')->with('success', 'Field deleted successfully.');
    }
}
