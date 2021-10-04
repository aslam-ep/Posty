{{-- including the layouts.app content --}}
@extends('layouts.app')

{{-- Putting content as per our need --}}
@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            {{-- Using post blade template --}}
            <x-post-component :post="$post"/>
        </div>
    </div>
@endsection