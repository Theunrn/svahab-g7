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

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    public static function createOrder($validatedData)
    {
        $user = Auth::user();

        $order = new self();
        $order->user_id = $user->id;
        // $order->total_amount = $validatedData->total_amount;
        $order->order_date = now()->format('Y-m-d');
        $order->save();

        $product = Product::findOrFail($validatedData['product_id']);

        // Associate product with color and size
        $order->products()->attach($product, [
            'qty' => $validatedData['qty'],
            'color_id' => $validatedData['color_id'],
            'size_id' => $validatedData['size_id'],
        ]);

        return $order;
    }


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
            $this->order_status = 'confirmed';
            $this->save();
            return true;
        }
        return false;
    }
    public function confirmOrder()
    {
        $this->order_status = 'confirmed';
        $this->save();
        
        return $this;
    }
}



// public static function createOrder($validatedData)
    // {
    //     $user = Auth::user();

    //     $order = new self();
    //     $order->user_id = $user->id;
    //     $order->order_date = now()->format('Y-m-d');
    //     $order->save();

    //     $product = Product::findOrFail($validatedData['product_id']);

    //     // Associate product with color and size
    //     $order->products()->attach($product, [
    //         'qty' => $validatedData['qty'],
    //         'color_id' => $validatedData['color_id'],
    //         'size_id' => $validatedData['size_id'],
    //     ]);

    //     return $order;
    // }
