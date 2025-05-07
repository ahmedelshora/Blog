<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostCollection;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $pagination = $request->get('pagination', 10);

        $posts = Post::with(['category', 'user'])
            ->withCommentsCount()
            ->filter($request->only('search'))
            ->paginate($pagination);
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => PostCollection::make($posts),
            'meta' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
            ],
        ]);
    }

}
