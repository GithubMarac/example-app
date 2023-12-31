<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $translatedModel = $this->translateOrDefault($request->input('lang'));

        return [
            'id' => $this->id,
            'title' => $translatedModel->title,
            'slug' => $this->slug
        ];
    }
}
