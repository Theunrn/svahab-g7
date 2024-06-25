<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'field_name',
        'field_location', // Corrected typo
        'field_type',
        'field_size',
        'number_of_players',
        'lighting_availability'
    ];

    
}
