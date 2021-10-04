{{-- including the layouts.app content --}}
@extends('layouts.app')

{{-- Putting content as per our need --}}
@section('content')
    <div class="flex justify-center">
        <div class="w-8/12">
            <div class="p-6">
                <h1 class="text-2xl font-medium">{{ $user->name }}</h1>
                <p>Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }}
                and recived {{ $user->recivedLikes->count() }} {{ Str::plural('like', $user->recivedLikes->count()) }}</p>
            </div>

            <div class="bg-white p-6 rounded-lg">
                @if ($posts->count())
                @foreach ($posts as $post)
                    {{-- Using blade component --}}
                    <x-post-component :post="$post"/>
                @endforeach
                
                {{-- Paginator because we used paginate on query builder --}}
                {{ $posts->links() }}
                @else
                    <p>{{ $user->name }} does not have any posts</p>
                @endif
            </div>
        </div>
    </div>
@endsection