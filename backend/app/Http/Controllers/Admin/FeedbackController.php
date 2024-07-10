<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with(['user', 'field'])->get();
        return view('setting.feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        return view('setting.feedback.create');
    }

    public function store(Request $request)
    {
        Feedback::create([
            'user_id' => $request->input('user'),
            'field_id' => $request->input('field'),
            'feedback_text' => $request->input('feedback_text'),
        ]);

        return redirect()->route('admin.feedbacks.index')->with('success', 'Feedback created successfully');
    }

    public function edit(string $id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('setting.feedback.edit', compact('feedback'));
    }

    public function update(Request $request, string $id)
    {
        Feedback::findOrFail($id)->update([
            'user_id' => $request->input('user'),
            'field_id' => $request->input('field'),
            'feedback_text' => $request->input('feedback_text'),
        ]);

        return redirect()->route('admin.feedbacks.index')->with('success', 'Feedback updated successfully');
    }

    public function destroy(string $id)
    {
        Feedback::findOrFail($id)->delete();
        return redirect()->route('admin.feedbacks.index')->with('success', 'Feedback deleted successfully');
    }
}
