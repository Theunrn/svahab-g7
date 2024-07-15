<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                $filename = time(). '.'. $file->extension(); 
               
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

    public function getLatestPostTeam()
    {
        $latestPostTeam = Post::latest()->first();
        $latestPostTeam->logo = asset('storage/' . $latestPostTeam->logo); // Assuming logo is stored in 'public/storage/images/'
        return response()->json($latestPostTeam);
    }
}
