@extends('layouts.app')

@section('title', 'Sürücü Düzenle')

@section('content')

<div class="max-w-2xl mx-auto">

    <div class="mb-6">
        <a href="{{ route('drivers.index') }}"
           class="text-sm text-blue-600 hover:underline">← Listeye Dön</a>
        <h1 class="text-2xl font-bold text-gray-800 mt-2">Sürücü Düzenle</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 sm:p-8">
        <form method="POST" action="{{ route('drivers.update', $driver) }}" novalidate>
            @csrf
            @method('PUT')
            @include('drivers._form', ['driver' => $driver])

            <div class="mt-8 flex items-center gap-4">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-lg text-sm transition">
                    Güncelle
                </button>
                <a href="{{ route('drivers.index') }}"
                   class="text-sm text-gray-500 hover:text-gray-700">
                    İptal
                </a>
            </div>

        </form>
    </div>

</div>

@endsection
