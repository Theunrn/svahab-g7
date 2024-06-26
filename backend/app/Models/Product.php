<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'image', 'color', 'size', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $casts = [
        'color' => 'array', // Cast the 'color' attribute to array
        'size' => 'array',  // Cast the 'size' attribute to array
    ];

    public static function store($request, $id = null) {

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
