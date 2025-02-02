@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md border-t-4 border-red-600">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">التسجيل</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">الاسم</label>
                <input id="name" type="text" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-red-300" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                <input id="email" type="email" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-red-300" name="email" value="{{ old('email') }}" required>
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

            <div class="mb-4">
                <label for="password-confirm" class="block text-sm font-medium text-gray-700">تأكيد كلمة المرور</label>
                <input id="password-confirm" type="password" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-red-300" name="password_confirmation" required>
            </div>

            <div class="mb-4">
                <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
                    التسجيل
                </button>
            </div>

            <div class="text-center">
                <p class="text-sm text-gray-600">لديك حساب بالفعل؟ 
                    <a href="{{ route('login') }}" class="text-red-500 hover:underline">تسجيل الدخول</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
