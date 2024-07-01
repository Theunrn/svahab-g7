<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['image','name', 'description', 'price', 'color', 'size', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_colors', 'product_id', 'color_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes', 'product_id', 'size_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_orders')
                    ->withPivot('qty', 'color_id', 'size_id');
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    protected $casts = [
        'color' => 'array', // Cast the 'color' attribute to array
        'size' => 'array',  // Cast the 'size' attribute to array
    ];

    public function getDiscountedPriceAttribute()
    {
        $latestDiscount = $this->discounts()->latest()->first();

        if ($latestDiscount) {
            $discountedPrice = $this->price - ($this->price * ($latestDiscount->discount / 100));
            return $discountedPrice;
        }

        return $this->price; // Return original price if no discount found
    }

    public static function store($request, $id = null)
    {

        $data = $request->only('name', 'description', 'price', 'category_id', 'size', 'color');
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv|max:20480',
            ]);
            $image = $request->file('image')->store('images', 'public');
            $data['image'] = Storage::url($image);
        } else {
            $data['image'] = $request->input('image');
        }

        $product = self::updateOrCreate(['id' => $id], $data);
        return $product;
    }

}
