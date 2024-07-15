<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        // Retrieve all posts
        $posts = Post::all();

        // Return posts as a JSON response
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'start_match' => 'required|date',
            'end_match' => 'required|date',
            'start_time' => 'required|date_format:H:i', // Ensure start_time is in H:i format (24-hour)
            'end_time' => 'required|date_format:H:i',   // Ensure end_time is in H:i format (24-hour)
            'location' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle logo file upload
        if ($request->hasFile('logo')) {
            try {
                $file = $request->file('logo');
                $filename = time(). '.'. $file->extension(); // Generate unique filename based on current timestamp and extension
               

                // Store the uploaded file in public/images directory
                $file->storeAs('public/images', $filename);

                // Create a new Post instance
                $post = new Post();
                $post->user_id = Auth::id(); // Assign logged-in user's ID
                $post->name = $request->name;
                $post->start_match = $request->start_match;
                $post->end_match = $request->end_match;
                $post->start_time = $request->start_time;
                $post->end_time = $request->end_time;
                $post->location = $request->location;
                $post->logo = 'images/' . $filename; // Save relative path to the logo
                $post->post_date = now(); // Alternatively, you can use $post['post_date'] = now();

                // Save the post
                $post->save();

                // Return a JSON response indicating success
                return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
            } catch (\Exception $e) {
                // Handle any errors that occur during file upload or saving
                return response()->json(['error' => 'Failed to upload logo: ' . $e->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => 'Logo file not found'], 400);
        }
    }

    public function getLatestPostTeam()
    {
        $latestPostTeam = Post::latest()->first();
        $latestPostTeam->logo = asset('storage/' . $latestPostTeam->logo); // Assuming logo is stored in 'public/storage/images/'
        return response()->json($latestPostTeam);
    }
}
