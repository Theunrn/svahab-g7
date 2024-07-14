<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
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
    $request->validate([
        'name' => 'required|string|max:255',
        'start_match' => 'required|date',
        'end_match' => 'required|date',
        'start_time' => 'required|date_format:H:i', // Ensure start_time is in H:i format (24-hour)
        'end_time' => 'required|date_format:H:i',   // Ensure end_time is in H:i format (24-hour)
        'location' => 'required|string|max:255',
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $post = new Post();
    $post->user_id = auth()->user()->id;
    $post->name = $request->name;
    $post->start_match = $request->start_match;
    $post->end_match = $request->end_match;
    $post->start_time = $request->start_time; // Assign start_time
    $post->end_time = $request->end_time;     // Assign end_time
    $post->location = $request->location;

    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        $post->logo = $filename;
    }
    $post->post_date = now(); // Alternatively, you can use $post['post_date'] = now();

    $post->save();

    return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
}

    public function getLatestPostTeam()
    {
        $latestPostTeam = Post::latest()->first();
        $latestPostTeam->logo = asset('uploads/' . $latestPostTeam->logo); // Assuming logo is stored in 'public/uploads/'
        return response()->json($latestPostTeam);
    }
    // public function show($id)
    // {
    //     // Find post by ID
    //     $post = Post::find($id);

    //     // Check if post exists
    //     if (!$post) {
    //         return response()->json(['message' => 'Post not found'], 404);
    //     }

    //     // Return the found post as a JSON response
    //     return response()->json($post);
    // }

    // public function update(PostRequest $request, $id)
    // {
    //     // Find post by ID
    //     $post = Post::find($id);

    //     // Check if post exists
    //     if (!$post) {
    //         return response()->json(['message' => 'Post not found'], 404);
    //     }

    //     // Update post with request data
    //     $post->update($request->all());

    //     // Return the updated post as a JSON response
    //     return response()->json($post);
    // }

    // public function destroy($id)
    // {
    //     // Find post by ID
    //     $post = Post::find($id);

    //     // Check if post exists
    //     if (!$post) {
    //         return response()->json(['message' => 'Post not found'], 404);
    //     }

    //     // Delete the post
    //     $post->delete();

    //     // Return a success message as a JSON response
    //     return response()->json(['message' => 'Post deleted successfully']);
    // }
}
