<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LikeController extends Controller
{
    /**
     * Only authenticated user can like a post
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * @return back or response()
     */
    public function store(Post $post, Request $request)
    {
        /**
         * Only allowing liking if not liked
         */
        if ($post->likedBy($request->user())) {
            return response(null, 400);
        }

        /**
         * Checking if its previously not liked or liked
         */

        if (!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()) {
            $post->likes()->create([
                'user_id' => $request->user()->id,
            ]);
    
            Mail::to($post->user)->send(new PostLiked($request->user(), $post));
        } else {
            // Restoring deleted_at value to null 
            $post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->restore();
        }

        return back();
    }

    /**
     * @return back()
     */
    public function destroy(Post $post, Request $request)
    {
        // Deleting like by the specific user on a specific post
        $request->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
}
