@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
    <p class="text-gray-700 leading-relaxed">{{ $post->description }}</p>

    <div class="mt-4">
        <a href="{{ route('posts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">العودة للقائمة</a>
        <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">تعديل البوست</a>
    </div>
</div>
@endsection