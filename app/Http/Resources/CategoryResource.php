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
        return [
          'id' => $this->id,
          'slug' => $this->slug,
          'image' => $this->translation->image,
          'name' => $this->translation->name,
          'description' => $this->translation->description,
        ];
    }
}
