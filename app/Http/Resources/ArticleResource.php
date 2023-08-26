<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'title' => $this->title,
            'body' => $this->body,
            'published' => $this->created_at->diffForHumans(),
            'subject' => $this->subject->name,
            'author' => $this->user->name
        ];
    }

    public function with($request){
        return ['status' => 'success'];
    }
}
