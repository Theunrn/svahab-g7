<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class OrderProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => $this->user ? $this->user->name : 'Unknown User',
            'order_date' => Carbon::parse($this->order_date)->translatedFormat('l, d F, Y'), 
            'products' => $this->products->map(function ($product) {
                $totalPrice = $product->pivot->qty * $product->price;

                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'qty' => $product->pivot->qty,
                    'price' => number_format($product->price, 2),
                    'total' => number_format($totalPrice, 2),
                    'color' => $product->pivot->color_id ? $product->colors->firstWhere('id', $product->pivot->color_id)->name ?? null : null,
                    'size' => $product->pivot->size_id ? $product->sizes->firstWhere('id', $product->pivot->size_id)->name ?? null : null,
                ];
            }),
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];
    }
}
