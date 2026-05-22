<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Sürücü Rehberi')</title>

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <span class="text-xl font-bold text-gray-800">🚗 Sürücü Rehberi</span>
            <div class="flex items-center gap-4">
                @auth
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('drivers.create') }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                            + Sürücü Ekle
                        </a>
                    @endif
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">Giriş</a>
                    <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-gray-900">Kayıt Ol</a>
                @endguest
                @auth
                    <span class="text-sm text-gray-600">Merhaba, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-600 hover:text-gray-900">Çıkış</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    @if (session('success'))
        <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

</body>
</html>
