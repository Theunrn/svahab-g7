<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::all();
        return response()->json(['success' => true,  'data' => $feedback], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'field_id' => 'required|exists:fields,id',
            'feedback_text' => 'required|string',
        ]);

        $feedback = Feedback::create($request->all());

        return response()->json(['success' => true, 'message' => 'Feedback created successfully', 'data' => $feedback], 200);
    }

    public function show(Feedback $feedback)
    {
        return $feedback;
    }

    public function update(Request $request, Feedback $feedback)
    {
        $request->validate([
            'user_id' => 'exists:users,id',
            'field_id' => 'exists:fields,id',
            'feedback_text' => 'string',
        ]);

        $feedback->update($request->all());

        return response()->json(['success' => true, 'message' => 'Feedback updated successfully'], 200);
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return response()->json(['message' => 'Feedback deleted'], 200);
    }
}
