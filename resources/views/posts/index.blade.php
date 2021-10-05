{{-- including the layouts.app content --}}
@extends('layouts.app')

{{-- Putting content as per our need --}}
@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @auth
                {{-- Set encription type to perform file upload --}}
                <form action="{{ route('posts') }}" method="post" enctype="multipart/form-data" class="mb-4">
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="sr-only">Body</label>
                        <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100
                        border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
                        placeholder="Post Something">{{ old('body') }}</textarea>

                        @error('body')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="flex justify-between">
                        <div class="flex items-center">
                            <label class="flex items-center bg-blue-500 rounded-md shadow-md px-2 py-1 text-white cursor-pointer">
                                <span class="text-base leading-normal">Select </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <input type="file" name="image" id="image" accept="image/*" class="hidden">
                            </label>
                            
                            @error('image')
                                <div class="text-red-500 ml-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded 
                            font-medium">Post</button>
                        </div>
                    </div>


                    <div>
                        
                    </div>
                </form> 
            @endauth

            @if ($posts->count())
                @foreach ($posts as $post)
                    {{-- Using blade component --}}
                    <x-post-component :post="$post"/>
                @endforeach
                
                {{-- Paginator because we used paginate on query builder --}}
                {{ $posts->links() }}
            @else
                <p>There are no posts</p>
            @endif
        </div>
    </div>
@endsection