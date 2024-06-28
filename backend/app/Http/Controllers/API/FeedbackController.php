<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
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
        $feedbacks = Feedback::all();
        $feedbacks = FeedbackResource::collection($feedbacks);
        return ['success'=>true, 'data'=>$feedbacks];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeedbackRequest $request)
    {
        Feedback::store($request);
        return ["success" => true, "Message" =>"feedback created successfully"];

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feedback = Feedback::find($id);
        $feedback = new FeedbackResource($feedback);
        return ['success'=>true, 'data'=>$feedback];

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeedbackRequest $request, string $id)
    {
        Feedback::store($request, $id);
        return ["success" => true, "Message" =>"feedback update successfully"];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Feedback::destroy($id);
        return ["success" => true, "Message" =>"feedback deleted successfully"];
    }
}
