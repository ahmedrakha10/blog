<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'description'    => $this->description,
            'views'          => $this->views,
            'published_date' => $this->created_at->format('d-m-Y'),
            'image'          => $this->image ? url($this->image) : null,
            'category'       => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
