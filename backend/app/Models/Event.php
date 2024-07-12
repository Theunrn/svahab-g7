<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'field_id', 'title', 'start', 'end'];

    public static function store($request, $id=null){
        $data = $request->only('field_id', 'title', 'start', 'end');
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
    }
}
