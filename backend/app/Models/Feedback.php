<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'field_id',
        'feedback_text',
    ];

    public function users():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public static function store($request, $id = null){
        $data = $request->only('user_id', 'field_id', 'feedback_text');
        $data = self::updateOrCreate(['id' => $id], $data);
        return $data;
        
    }
    public static function destroy($id)
    {
        $data = self::find($id);
        $data->delete();
        return $data;
    }
}
