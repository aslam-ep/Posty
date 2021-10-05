<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Fileds that can be added to table using create
     */
    protected $fillable = [
        'body',
        'post_img',
    ];

    /**
     * @return bool
     */
    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    /**
     * @return belongsTo relation
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return hasMany relation to likes
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
