<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_orders')
            ->withPivot('qty', 'color_id', 'size_id');
    }

    public static function createOrder($validatedData)
    {
        $user = Auth::user();

        $order = new self();
        $order->user_id = $user->id;
        $order->order_date = now()->format('Y-m-d');
        $order->save();

        $product = Product::findOrFail($validatedData['product_id']);

        // Associate product with color and size
        $order->products()->attach($product, [
            'qty' => $validatedData['qty'],
            'color_id' => $validatedData['color_id'], // Assuming color_id is passed from the request
            'size_id' => $validatedData['size_id'], // Assuming size_id is passed from the request
        ]);

        return $order;
    }
    

    // public static function createOrder($validatedData)
    // {
    //     $user = Auth::user();

    //     $order = new self();
    //     $order->user_id = $user->id;
    //     $order->order_date = now()->format('Y-m-d');
    //     $order->save();

    //     $product = Product::findOrFail($validatedData['product_id']);
    //     $colorIds = $validatedData['color_id'];
    //     $sizeIds = $validatedData['size_id'];
    //     $qty = $validatedData['qty'];

    //     foreach ($productIds as $index => $productId) {
    //         $product = Product::findOrFail($productId);

    //         // Use the corresponding color_id and size_id for each product
    //         $colorId = $colorIds[$index];
    //         $sizeId = $sizeIds[$index];

    //         $order->products()->sync([
    //             $productId => [
    //                 'qty' => $qty[$index],
    //                 'color_id' => $colorId,
    //                 'size_id' => $sizeId,
    //             ],
    //         ]);
    //     }

    //     return $order;
    // }


    public function cancelOrder()
    {
        if ($this->order_status !== 'cancelled') {
            $this->order_status = 'cancelled';
            $this->save();
            return ['message' => 'Order cancelled successfully'];
        } else {
            return ['message' => 'Order is already cancelled'];
        }
    }


    public function reactivate()
    {
        if ($this->order_status === 'cancelled') {
            $this->order_status = 'comfirmed';
            $this->save();
            return true;
        }
        return false;
    }

}
