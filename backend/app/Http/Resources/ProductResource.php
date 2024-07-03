<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
            'colors' => $this->colors,
            'sizes' => $this->sizes,
            'discounted_price' => $this->discountedPrice, // Adjust this according to your model property
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }

}
