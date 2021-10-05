{{-- post-component template --}}

@props([
    'post' => $post
])

<div class="mb-4">
    <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a>
    {{-- Date is a carbon object so we can use its methods on it --}}
    <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>

    <div class="w-1/4 mt-2 mb-2 bg-white shadow-md rounded-md overflow-hidden">
        @if ($post->post_img)
            <img src="{{ asset('images/posts/'.$post->post_img) }}" alt="" class="object-fill w-full h-40"/>
        @else
            <img src="{{ asset('images/posts/post.jpg') }}" alt="" class="object-fill w-full h-48"/>
        @endif
    </div>

    <p class="mb-2">{{ $post->body }}</p>

    {{-- Deleting post created by the logined user --}}
    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="post" class="mr-1">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-blue-500">Delete</button>
        </form>
    @endcan

    {{-- div for forms for like and unlike --}}
    <div class="flex items-center">
        @auth
            @if (!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>
            @else
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf

                    {{-- Spoofing method to delete --}}
                    @method('DELETE')

                    <button type="submit" class="text-blue-500">Unlike</button>
                </form>
            @endif
        @endauth

        <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
    </div>
</div>