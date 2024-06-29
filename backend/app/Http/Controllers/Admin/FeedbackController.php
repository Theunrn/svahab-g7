<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = Feedback::with('users')->get();
        $feedbacks = Feedback::with('field')->get();
        $feedbacks = FeedbackResource::collection($feedbacks);
        return view('setting.feedback.index', compact('feedbacks'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('setting.feedback.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required|integer',
            'field' => 'required|integer',
            'feedback_text' => 'required|string|max:255',
        ]);

        Feedback::create([
            'user_id' => $request->input('user'),
            'field_id' => $request->input('field'),
            'feedback_text' => $request->input('feedback_text'),
        ]);

        return redirect()->route('admin.feedbacks.index')->with('success', 'Feedback created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $feedback= Feedback::find($id);
        return view('setting.feedback.edit', compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user' => 'required|integer',
            'field' => 'required|integer',
            'feedback_text' => 'required|string|max:255',
        ]);
        Feedback::find($id)->update([
            'user_id' => $request->input('user'),
            'field_id' => $request->input('field'),
            'feedback_text' => $request->input('feedback_text'),
        ]);
        return redirect()->route('admin.feedbacks.index')->with('success', 'Feedback updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feedbacks = Feedback::find($id);
        $feedbacks->delete();
        return redirect()->route('admin.feedbacks.index')->with('success', 'Feedback deleted successfully');
    }
}
