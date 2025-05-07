<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use  App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Http\Resources\PostDetailsResource;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => $request->user()->id,
        ]);

    
        $post->load(['category', 'user','comments']);
        return response()->json([
            'status' => 201,
            'message' => 'Post created successfully.',
            'data' => new PostDetailsResource($post),
        ], 201);
    }
}
