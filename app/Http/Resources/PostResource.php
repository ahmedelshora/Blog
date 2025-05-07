<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'category_name' => $this->getCategoryResource()->name,
            'user_name' => $this->getUserResource()->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'comments_count' => $this->comments_count,
            
        ];
    }

    /**
     * Get the user resource.
     *
     * @return \App\Http\Resources\UserResource
     */
    private function getUserResource()
    {
        return new UserResource($this->whenLoaded('user'));
    }

    /**
     * Get the category resource.
     *
     * @return \App\Http\Resources\CategoryResource
     */
    private function getCategoryResource()
    {
        return new CategoryResource($this->whenLoaded('category'));
    }
    

}
