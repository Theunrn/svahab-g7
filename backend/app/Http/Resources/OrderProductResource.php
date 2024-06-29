<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class OrderProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->user->name,
            'order_date' => Carbon::parse($this->order_date)->translatedFormat('l, d F, Y'), 
            'products' => $this->products->map(function ($product) {
                $totalPrice = $product->pivot->qty * $product->price;

                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'qty' => $product->pivot->qty,
                    'price' => number_format($product->price, 2),
                    'total' => number_format($totalPrice, 2),
                ];
            }),
        ];
    }

}
