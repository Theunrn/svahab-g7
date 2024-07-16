<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','logo', 'name', 'post_date', 'start_match', 'end_match','start_time','end_time', 'location'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

    /**
     * Store a new post.
     *
     * @param array $data
     * @return \App\Models\Post
     */
    public static function store($data)
    {
        // Handle logo file upload
        if (isset($data['logo']) && $data['logo']->isValid()) {
            $imageName = time() . '.' . $data['logo']->extension();
            $data['logo']->storeAs('public/images', $imageName);
            $data['logo'] = 'images/' . $imageName;
        }

        // Set post_date to current date and time
        $data['post_date'] = now();

        // Create and return a new post instance
        return self::create($data);
    }

}
