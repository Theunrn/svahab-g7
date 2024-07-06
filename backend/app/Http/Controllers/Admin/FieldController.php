<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FieldRequest;
use App\Http\Resources\FieldResource;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Store the file in the 'public' disk (or any other disk you have configured)
    $imageName = time() . '.' . $request->image->extension();
    $request->image->storeAs('public/images', $imageName);
    $validated['image'] = 'images/' . $imageName; 
    $validated['owner_id'] = Auth::id();
    Field::create($validated);
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

    public function update(Request $request, Field $field)
    {
        
        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,jfif,webp|max:2048',
            'price' => 'required|numeric|min:0',
            'field_type' => 'required|string|max:255',
            'owner_id' => 'required|integer',
            'availablity' => 'required|boolean',
        ]);

        // Handle file upload (image) if provided
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $field->image = 'images/' . $imageName; // assuming storage symlink is set up
        }

        // Update field details
        $field->name = $validatedData['name'];
        $field->location = $validatedData['location'];
        $field->price = $validatedData['price'];
        $field->field_type = $validatedData['field_type'];
        $field->owner_id = $validatedData['owner_id'];
        $field->availablity = $validatedData['availablity'];
       
        $field->save();

        // Redirect back with success message
        return redirect()->route('admin.fields.index')->with('success', 'Field updated successfully.');
    }


    public function destroy($id)
    {
        $field = Field::findOrFail($id);
        $field->delete();

        return redirect()->route('admin.fields.index')->with('success', 'Field deleted successfully.');
    }
}
