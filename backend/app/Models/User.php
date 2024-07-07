<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'qr', // Ensure 'qr' field is in fillable array
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function store($request)
    {
        // Initialize image path variable
        $imagePath = null;

        // Check if request has 'qr' file
        if ($request->hasFile('qr')) {
            // Validate 'qr' file
            $request->validate([
                'qr' => 'mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);

            // Store 'qr' file and get its path
            $imagePath = $request->file('qr')->store('images', 'public');
        }

        // Create user with form data and image path
        $user = self::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => bcrypt($request->password),
            'phone_number'      => $request->phone_number,
            'qr'                => $imagePath ? Storage::url($imagePath) : null, // Store URL if image uploaded, otherwise null
            'email_verified_at' => now(),
            'remember_token'    => Str::random(20),
        ]);

        // Assign role or perform any other operations as needed

        return $user;
    }

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }
}
