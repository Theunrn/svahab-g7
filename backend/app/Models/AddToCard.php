<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddToCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'total_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function list()
    {
        return self::with('products')->get();
    }

    public static function addToCart($userId, $productId, $quantity)
    {
        $product = Product::findOrFail($productId);

        $cartItem = self::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->total_amount = $cartItem->quantity * $cartItem->price;
            $cartItem->save();
        } else {
            $totalAmount = $product->price * $quantity;
            $cartItem = self::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
                'total_amount' => $totalAmount
            ]);
        }

        return $cartItem;
    }
    
}


// class AddToCard extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'user_id',
//         'product_id',
//         'color_id',
//         'size_id',
//         'quantity',
//         'price',
//         'total_amount',
//     ];

//     public function user()
//     {
//         return $this->belongsTo(User::class);
//     }

//     public function product()
//     {
//         return $this->belongsTo(Product::class);
//     }

//     public function color()
//     {
//         return $this->belongsTo(Color::class);
//     }

//     public function size()
//     {
//         return $this->belongsTo(Size::class);
//     }

//     public static function list()
//     {
//         return self::with('product')->get(); // Adjusted to 'product' instead of 'products'
//     }

//     public static function addToCart($userId, $productId, $colorId, $sizeId, $quantity)
//     {
//         $product = Product::findOrFail($productId);

//         $cartItem = self::where('user_id', $userId)
//                         ->where('product_id', $productId)
//                         ->where('color_id', $colorId)
//                         ->where('size_id', $sizeId)
//                         ->first();

//         if ($cartItem) {
//             $cartItem->quantity += $quantity;
//             $cartItem->total_amount = $cartItem->quantity * $cartItem->price;
//             $cartItem->save();
//         } else {
//             $totalAmount = $product->price * $quantity;
//             $cartItem = self::create([
//                 'user_id' => $userId,
//                 'product_id' => $productId,
//                 'color_id' => $colorId,
//                 'size_id' => $sizeId,
//                 'quantity' => $quantity,
//                 'price' => $product->price,
//                 'total_amount' => $totalAmount
//             ]);
//         }

//         return $cartItem;
//     }
// }