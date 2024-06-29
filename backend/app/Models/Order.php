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

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_orders')->withPivot('qty');
    }

    public static function createOrder($validatedData)
    {
        $user = Auth::user();

        $order = new self();
        $order->user_id = $user->id;
        $order->order_date = now()->format('Y-m-d');
        $order->save();

        $product = Product::findOrFail($validatedData['product_id']);
        $order->products()->attach($product, [
            'qty' => $validatedData['qty'],
            'color' => $validatedData['color'],
            'size' => $validatedData['size'],
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
            $this->order_status = 'comfirmed';
            $this->save();
            return true;
        }
        return false;
    }

}