@extends('layouts.app')

@section('content')

<!-- شريط البحث -->
<div class="flex justify-center mt-6">
    <form action="{{ route('posts.index') }}" method="GET" class="flex space-x-2">
        <input type="text" name="keyword" placeholder="ابحث عن مقال..." value="{{ request('keyword') }}"
               class="border border-gray-300 rounded px-4 py-2 focus:ring-red-500 focus:border-red-500">
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition">
            🔍 بحث
        </button>
    </form>
</div>

<!-- تقسيم الصفحات العلوي -->
<div class="mt-10 flex justify-center">
    {{ $posts->links('pagination::tailwind') }}
</div>

<div class="bg-white text-gray-900">
    <!-- الهيدر -->
    <header class="w-full py-6 bg-red-600 text-white text-center font-bold text-lg shadow-md">
        🚀 مرحبًا بك في مدونتنا التقنية
    </header>

    <!-- المحتوى الرئيسي -->
    <div class="max-w-6xl mx-auto px-6 py-12">
        <h1 class="text-5xl font-extrabold text-center text-gray-900">
            The PHP Framework <br>
            <span class="text-red-500">for Web Artisans</span>
        </h1>
        <p class="text-center text-lg text-gray-700 mt-4">
            هنا يمكنك استكشاف مقالات حول أحدث تقنيات تطوير الويب بطريقة سهلة واحترافية
        </p>

        <!-- زر إنشاء بوست جديد -->
        <div class="flex justify-center mt-6">
            <a href="{{ route('posts.create') }}" class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-6 py-3 rounded-lg text-lg font-semibold shadow-lg hover:scale-105 transition-transform duration-300">
                + إنشاء بوست جديد
            </a>
        </div>

        <!-- قائمة البوستات -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
            @foreach ($posts as $post)
                <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-2xl hover:scale-105 transition-transform duration-300 backdrop-blur-md bg-opacity-80">
                    
                    <!-- عرض صورة المقال إن وجدت -->
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-40 object-cover rounded-md mb-3">
                    @endif

                    <h2 class="text-2xl font-bold text-gray-800">{{ $post->title }}</h2>
                    <p class="text-gray-600 mt-2">{{ Str::limit($post->description, 100) }}</p>
                    
                    <!-- تنسيق التاريخ -->
                    <p class="text-gray-500 mt-1 text-sm">
                        📅 <span title="{{ $post->created_at->format('d M Y H:i') }}">{{ $post->created_at->diffForHumans() }}</span>
                    </p>

                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('posts.show', $post) }}" class="text-red-500 font-semibold hover:underline">👁️ عرض التفاصيل</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('⚠️ هل أنت متأكد من الحذف؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition">🗑️ حذف</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- تقسيم الصفحات السفلي -->
        <div class="mt-10 flex justify-center">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    </div>
</div>

@endsection
