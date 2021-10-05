<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        /**
         * Middleware only applicable to the store and destroy methods
         */
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index()
    {
        /**
         * Eager loding to reduce query count
         * By loading user and likes associted with post
         */
        $posts = Post::latest()->with(['user','likes'])->paginate(20);

        return view('posts.index',[
            'posts' => $posts,
        ]);
    }

    /**
     * @return view for single post
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Validate the form data
     * Push form data
     * @return back
     */
    public function store(Request $request)
    {
        /**
         * Methods on image
         * guessExtention
         * getMimeType
         * store
         * asStore
         * storePublicly
         * move
         * getClientOriginalName
         * getClientMimeType
         * guessClientExtention
         * getSize
         * getError
         * isValid
         * $test = $request->file('image')->isValid();
         */

        $this->validate($request, [
            'body' => 'required',
            'image' =>'required|mimes:jpg,png,jpeg|max:5048',
        ]);
        
        $newPostImageName = time() 
                            .'-' 
                            .'post.'
                            .$request->image->extension();

        $request->image->move(public_path('images/posts'), $newPostImageName);

        /**
         * posts() - return us the relationship object 
         * posts give us a collection can be used to fecth
         * we need relation so we use posts()
         * create() need an array as argument
         * $request->only() returns an array
         */
        $request->user()->posts()->create([
            'body' => $request->body,
            'post_img' => $newPostImageName,
        ]);

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        /**
         * Throw an exception 403 if its not authorized
         */
        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }
}
