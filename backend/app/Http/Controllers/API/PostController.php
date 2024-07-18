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
        $posts = Post::all();
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


    // Update a post
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'date_match' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Update validation rules for logo to be nullable
        ]);

        try {
            // Find the post by ID
            $post = Post::findOrFail($id);

            // Handle logo file upload if a new logo is provided
            if ($request->hasFile('logo')) {
                // Delete the old logo if it exists
                if ($post->logo) {
                    Storage::delete('public/' . $post->logo);
                }

                $file = $request->file('logo');
                $filename = time() . '.' . $file->extension();
                $file->storeAs('public/images', $filename);

                $post->logo = 'images/' . $filename;
            }

            // Update the post data
            $post->name = $request->name;
            $post->date_match = $request->date_match;
            $post->start_time = $request->start_time;
            $post->end_time = $request->end_time;
            $post->location = $request->location;

            // Save the updated post
            $post->save();

            // Return a JSON response indicating success
            return response()->json(['message' => 'Post updated successfully'], 200);
        } catch (\Exception $e) {
            // Handle any errors that occur during file upload, updating, or saving
            return response()->json(['error' => 'Failed to update post: ' . $e->getMessage()], 500);
        }
    }



    public function destroy($id)
    {
        try {
            // Find the post by ID
            $post = Post::findOrFail($id);

            // Check if the authenticated user created this post
            if ($post->user_id !== Auth::id()) {
                return response()->json(['error' => 'Unauthorized action'], 403);
            }

            // Delete the post and its associated logo file if exists
            if ($post->logo && Storage::exists('public/' . $post->logo)) {
                Storage::delete('public/' . $post->logo);
            }

            // Delete the post
            $post->delete();

            return response()->json(['message' => 'Post deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete the post.'], 500);
        }
    }
}
