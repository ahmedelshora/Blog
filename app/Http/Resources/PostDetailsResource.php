<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailsResource extends MainPostResource
{
     /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request) + [
            'comments' => $this->getCommentsCollection(),
        ];
    }

 /**
     * Get the category resource.
     *
     * @return \App\Http\Resources\CategoryResource
     */
    protected function getCommentsCollection()
    {
        return CommentResource::collection($this->whenLoaded('comments'));
    }
}
