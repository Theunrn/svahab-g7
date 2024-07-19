<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // Add this line

class PostController extends Controller
{
    public function index()
    {
        // Retrieve all posts
        $posts = Post::where('status', false)->get();
        $posts = PostResource::collection($posts);
        // Return posts as a JSON response
        return response()->json(['success' => true, 'data' => $posts]);
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'date_match' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle logo file upload
        if ($request->hasFile('logo')) {
            try {
                $file = $request->file('logo');
                $filename = time() . '.' . $file->extension();

                $file->storeAs('public/images', $filename);

                $post = new Post();
                $post->user_id = Auth::id();
                $post->name = $request->name;
                $post->date_match = $request->date_match;
                $post->start_time = $request->start_time;
                $post->end_time = $request->end_time;
                $post->location = $request->location;
                $post->status = false;
                $post->logo = 'images/' . $filename; 
                $post->post_date = now(); 

                $post->save();

                // Return a JSON response indicating success
                return response()->json(['message' => 'Post created successfully'], 201);
            } catch (\Exception $e) {
                // Handle any errors that occur during file upload or saving
                return response()->json(['error' => 'Failed to upload logo: ' . $e->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => 'Logo file not found'], 400);
        }
    }

    public function show($id)
    {
        $post = Post::find($id);
        return response()->json(['success' => true, 'data' => $post]);
    }

    public function update(Request $request, $id)
{
    // Find the post by ID
    $post = Post::find($id);
    if (!$post) {
        return response()->json(['error' => 'Post not found'], 404);
    }

    // Validate incoming request data
    $validatedData = $request->validate([
        'name' => 'sometimes|required|string|max:255',
        'date_match' => 'sometimes|required|date',
        'start_time' => 'sometimes|required|date_format:H:i',
        'end_time' => 'sometimes|required|date_format:H:i',
        'location' => 'sometimes|required|string|max:255',
        'logo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Update post fields if provided
    $post->name = $request->input('name', $post->name);
    $post->date_match = $request->input('date_match', $request->date_match);
    $post->start_time = $request->input('start_time', $post->start_time);
    $post->end_time = $request->input('end_time', $post->end_time);
    $post->location = $request->input('location', $post->location);

    // Handle logo file upload if provided
    if ($request->hasFile('logo')) {
        try {
            // Delete old logo if exists
            if ($post->logo && Storage::exists('public/' . $post->logo)) {
                Storage::delete('public/' . $post->logo);
            }

            $file = $request->file('logo');
            $filename = time() . '.' . $file->extension();
            $file->storeAs('public/images', $filename);
            $post->logo = 'images/' . $filename;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to upload new logo: ' . $e->getMessage()], 500);
        }
    }

    // Save the updated post
    $post->save();

    // Return the updated post data
    return response()->json(['message' => 'Post updated successfully', 'data' => $post], 200);
}


    public function destroy($id)
    {
        // Find the post by ID
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        // Delete the logo file if exists
        if ($post->logo && Storage::exists('public/' . $post->logo)) {
            Storage::delete('public/' . $post->logo);
        }

        // Delete the post
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
    public function updatePostStatus( $id){
        $post = Post::find($id);
        $post->status = true;
        $post->save();
        return response()->json(['message' => 'Post status updated successfully'], 200);
    }
}
