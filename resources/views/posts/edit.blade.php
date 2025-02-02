@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">update post </h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-gray-700">adrees</label>
            <input type="text" name="title" class="w-full p-2 border rounded" value="{{ $post->title }}" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">descreption</label>
            <textarea name="description" class="w-full p-2 border rounded" rows="5" required>{{ $post->description }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">تحديث البوست</button>
    </form>
</div>
@endsection