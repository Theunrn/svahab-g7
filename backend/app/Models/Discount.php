<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'product_id', 'discount'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'discount_products', 'discount_id', 'product_id')
            ->withTimestamps();
    }

    public static function list()
    {
        return self::with('products')->get();
    }

    public static function store($request, $id = null)
    {
        $data = $request->only("title", "discount");
        $discount = self::updateOrCreate(['id' => $id], $data);
        if ($request->has('product_id')) {
            $discount->products()->sync($request->product_id);
        }
        return $discount;
    }

}
