@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">create new post</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700">adress</label>
            <input type="text" name="title" class="w-full p-2 border rounded" value="{{ old('title') }}" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">الوصف</label>
            <textarea name="description" class="w-full p-2 border rounded" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">save post</button>
    </form>
</div>
@endsection