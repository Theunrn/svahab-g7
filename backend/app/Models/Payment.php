<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'owner_id', 'amount', 'method', 'code', 'currency', 'payment_date'];

    public function customer(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }
    public static function store($request, $id=null){
        $data = $request->only('user_id', 'owner_id', 'amount', 'method', 'code', 'currency', 'payment_date');
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
    }
}
