<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /** 
     * by defining policy it can be accessed with authorize('delete', argu)
     * Look at PostController destroy() method
     * @return whether a post can be deleted by this user or not
     */
    public function delete(User $user, Post $post)
    {
        return $user->id===$post->user_id;
    }
}
