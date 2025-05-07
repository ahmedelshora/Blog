<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostDetailsResource;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        $post = Post::with(['category', 'user', 'comments'])
            ->findOrFail($id);

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => new PostDetailsResource($post)
        ]);
    }
}
