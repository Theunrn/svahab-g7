<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'image',
        'name',
        'description',
        'price',
        'color',
        'size'
    ];
    protected $casts = [
        'color' => 'array',
        'size' => 'array',
    ];
    


    // list all product
    public static function list(){
        $product = self::all();
        return $product;
    }

    //store
    public static function store($request, $id = null)
    {
        $data = $request->only('image', 'name', 'description', 'color', 'size');
        $data = self::updateOrCreate(['id' => $id], $data);
    }


}
