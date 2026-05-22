@extends('layouts.app')

@section('title', 'Yeni Sürücü Ekle')

@section('content')

<div class="max-w-2xl mx-auto">

    <div class="mb-6">
        <a href="{{ route('drivers.index') }}"
           class="text-sm text-blue-600 hover:underline">← Listeye Dön</a>
        <h1 class="text-2xl font-bold text-gray-800 mt-2">Yeni Sürücü Ekle</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 sm:p-8">
        <form method="POST" action="{{ route('drivers.store') }}" novalidate>
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Ad Soyad <span class="text-red-500">*</span>
                    </label>
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
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Telefon <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm
                                  @error('phone') border-red-400 bg-red-50 @else border-gray-300 @enderror
                                  focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="05xxxxxxxxx" />
                    @error('phone')
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
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Ehliyet Numarası <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="license_number" value="{{ old('license_number') }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm font-mono
                                  @error('license_number') border-red-400 bg-red-50 @else border-gray-300 @enderror
                                  focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="AB-1234-CD" />
                    @error('license_number')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Ehliyet Bitiş Tarihi <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="license_expiry" value="{{ old('license_expiry') }}"
                           min="{{ now()->addDay()->format('Y-m-d') }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm
                                  @error('license_expiry') border-red-400 bg-red-50 @else border-gray-300 @enderror
                                  focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('license_expiry')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Araç Tipi <span class="text-red-500">*</span>
                    </label>
                    <select name="vehicle_type"
                            class="w-full border rounded-lg px-3 py-2 text-sm
                                   @error('vehicle_type') border-red-400 bg-red-50 @else border-gray-300 @enderror
                                   focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Seçiniz</option>
                        @foreach ($vehicleTypes as $key => $label)
                            <option value="{{ $key }}" {{ old('vehicle_type') === $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('vehicle_type')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Durum <span class="text-red-500">*</span>
                    </label>
                    <select name="status"
                            class="w-full border rounded-lg px-3 py-2 text-sm
                                   @error('status') border-red-400 bg-red-50 @else border-gray-300 @enderror
                                   focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Seçiniz</option>
                        @foreach ($statuses as $key => $label)
                            <option value="{{ $key }}" {{ old('status') === $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="mt-8 flex items-center gap-4">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-lg text-sm transition">
                    Kaydet
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
