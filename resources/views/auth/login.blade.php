@extends('layouts.app')

@section('title', 'Giriş Yap')

@section('content')

<div class="max-w-md mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Giriş Yap</h1>
        <p class="text-sm text-gray-500 mt-1">Hesabına giriş yap.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 sm:p-8">
        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        E-posta
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm
                                  @error('email') border-red-400 bg-red-50 @else border-gray-300 @enderror
                                  focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="admin@example.com" />
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Şifre</label>
                    <input type="password" name="password"
                           class="w-full border rounded-lg px-3 py-2 text-sm
                                  @error('password') border-red-400 bg-red-50 @else border-gray-300 @enderror
                                  focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Şifreniz" />
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-lg text-sm transition">
                    Giriş Yap
                </button>
                <a href="{{ route('register') }}" class="text-sm text-gray-500 hover:text-gray-700">
                    Hesabın yok mu?
                </a>
            </div>
        </form>
    </div>

</div>

@endsection
