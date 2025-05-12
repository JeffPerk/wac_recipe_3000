<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'author_email' => $this->author_email,
            'ingredients' => $this->ingredients->pluck('name'),
            'steps' => $this->steps->sortBy('step_number')->pluck('description'),
        ];
    }
}