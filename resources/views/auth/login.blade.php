@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md border-t-4 border-red-600">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">تسجيل الدخول</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                <input id="email" type="email" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-red-300" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">كلمة المرور</label>
                <input id="password" type="password" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-red-300" name="password" required>
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox text-red-500">
                    <span class="ml-2 text-sm text-gray-600">تذكرني</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm text-red-500 hover:underline" href="{{ route('password.request') }}">نسيت كلمة المرور؟</a>
                @endif
            </div>

            <div class="mb-4">
                <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
                    تسجيل الدخول
                </button>
            </div>

            <div class="text-center">
                <p class="text-sm text-gray-600">ليس لديك حساب؟ 
                    <a href="{{ route('register') }}" class="text-red-500 hover:underline">التسجيل</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
