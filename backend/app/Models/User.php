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
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'profile',
        'qr'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function store($request)
    {
        // Initialize image variable
        $imagePath = null;
    
        // Check if the request has a file and validate it
        if ($request->hasFile('qr')) {
            $request->validate([
                'qr' => 'mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov,wmv|max:20480',
            ]);
    
            // Store the file and get the path
            $imagePath = $request->file('qr')->store('images', 'public');
        }
    
        // Create the user with the image path
        $user = self::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => bcrypt($request->password),
            'phone_number'      => $request->phone_number,
            'qr'                => $imagePath ? Storage::url($imagePath) : null,
            'email_verified_at' => now(),
            'remember_token'    => Str::random(20),
        ]);
    
        // Assign the role
        $user->assignRole('owner');

        // Create the token for API access
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return $user;
    }
    
    
    public function addToCards()
    {
        return $this->hasMany(AddToCard::class);
    }

}
