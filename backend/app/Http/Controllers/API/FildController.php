<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;

class FildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fields = Field::all();
        return response()->json($fields);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'field_name' => 'required|string|max:255',
            'field_location' => 'required|string|max:255',
            'surface_type' => 'required|string|max:255',
            'dimensions' => 'required|string|max:255',
            'capacity' => 'nullable|integer',
            'availablity' => 'required|boolean',
            'home_team' => 'required|string|max:255',
        ]);

        $field = Field::create($request->all());

        return response()->json(
            [
                'field' => $field,
               'message' => 'Field created successfully'
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $field = Field::find($id);
        if (is_null($field)) {
            return response()->json(['message' => 'Field not found'], 404);
        }
        return response()->json($field);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'field_name' => 'required|string|max:255',
            'field_location' => 'required|string|max:255',
            'surface_type' => 'required|string|max:255',
            'dimensions' => 'required|string|max:255',
            'capacity' => 'nullable|integer',
            'availablity' => 'required|boolean',
            'home_team' => 'required|string|max:255',
        ]);

        $field = Field::find($id);
        if (is_null($field)) {
            return response()->json(['message' => 'Field not found'], 404);
        }
        $field->update($request->all());
        return response()->json($field);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $field = Field::find($id);
        if (is_null($field)) {
            return response()->json(['message' => 'Field not found'], 404);
        }
        $field->delete();
        return response()->json(['message'=>'Field was delete'],200);
    }
}
