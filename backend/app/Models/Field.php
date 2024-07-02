<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'location',
        'field_type',
        'owner_id',
        'availablity',
    ];
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
