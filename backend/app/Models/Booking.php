<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','field_id','booking_date', 'total_price','status','payment_status', 'start_time','end_time'];
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }
    public static function store($request, $id = null) {

        $data = $request->only('user_id', 'field_id', 'booking_date', 'start_time', 'end_time','total_price', 'status', 'payment_status');
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
    }
}
