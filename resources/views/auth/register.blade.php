@extends('layouts.app')

@section('title', 'Kayıt Ol')

@section('content')

<div class="max-w-md mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Kayıt Ol</h1>
        <p class="text-sm text-gray-500 mt-1">Yeni hesap oluştur.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 sm:p-8">
        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ad Soyad</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm
                                  @error('name') border-red-400 bg-red-50 @else border-gray-300 @enderror
                                  focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Örn: Ahmet Yılmaz" />
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">E-posta</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm
                                  @error('email') border-red-400 bg-red-50 @else border-gray-300 @enderror
                                  focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="ornek@mail.com" />
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
                           placeholder="En az 6 karakter" />
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Şifre (Tekrar)</label>
                    <input type="password" name="password_confirmation"
                           class="w-full border rounded-lg px-3 py-2 text-sm border-gray-300
                                  focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Şifrenizi tekrar girin" />
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-lg text-sm transition">
                    Kayıt Ol
                </button>
                <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-700">
                    Zaten hesabın var mı?
                </a>
            </div>
        </form>
    </div>

</div>

@endsection
