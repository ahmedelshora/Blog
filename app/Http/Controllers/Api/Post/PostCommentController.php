<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Http\Resources\CommentResource;

class PostCommentController extends Controller
{
    public function __invoke(CommentRequest $request)
    {
        $comment = Comment::create([
            'content' => $request->content,
            'post_id' => $request->post_id,
            'user_id' => $request->user()->id,
        ]);
    
        return response()->json([
            'status' => 201,
            'message' => 'Comment created successfully.',
            'data' => new CommentResource($comment),
        ], 201);
    }
}
