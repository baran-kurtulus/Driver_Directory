@extends('layouts.app')

@section('title', 'Sürücü Listesi')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <h1 class="text-2xl font-bold text-gray-800">Sürücüler</h1>
    <span class="text-sm text-gray-500">Toplam: {{ $drivers->total() }} sürücü</span>
</div>

<form method="GET" action="{{ route('drivers.index') }}"
      class="bg-white rounded-xl shadow-sm p-4 mb-6 flex flex-wrap gap-4 items-end">

    <div class="flex-1 min-w-[160px]">
        <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase tracking-wide">Durum</label>
        <select name="status"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Tümü</option>
            @foreach ($statuses as $key => $label)
                <option value="{{ $key }}" {{ ($filters['status'] ?? '') === $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="flex-1 min-w-[160px]">
        <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase tracking-wide">Araç Tipi</label>
        <select name="vehicle_type"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Tümü</option>
            @foreach ($vehicleTypes as $key => $label)
                <option value="{{ $key }}" {{ ($filters['vehicle_type'] ?? '') === $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition">
        Filtrele
    </button>

    @if (!empty(array_filter($filters)))
        <a href="{{ route('drivers.index') }}"
           class="text-sm text-gray-500 hover:text-red-500 underline self-center">
            Temizle
        </a>
    @endif

</form>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Ad Soyad</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Telefon</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Ehliyet No</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Araç Tipi</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Durum</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Ehliyet Bitiş</th>
                    @if ($canManage)
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">İşlemler</th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($drivers as $driver)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-400">{{ $driver->id }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $driver->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $driver->phone }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 font-mono">{{ $driver->license_number }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ \App\Models\Driver::VEHICLE_TYPES[$driver->vehicle_type] ?? $driver->vehicle_type }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $badgeColors = [
                                    'active' => 'bg-green-100 text-green-800',
                                    'inactive' => 'bg-red-100 text-red-800',
                                    'on_trip' => 'bg-yellow-100 text-yellow-800',
                                ];
                            @endphp
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold
                                         {{ $badgeColors[$driver->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ \App\Models\Driver::STATUSES[$driver->status] ?? $driver->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $driver->license_expiry->format('d.m.Y') }}
                        </td>
                        @if ($canManage)
                            <td class="px-6 py-4 text-sm">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('drivers.edit', $driver) }}"
                                       class="text-blue-600 hover:text-blue-700 font-medium">
                                        Düzenle
                                    </a>
                                    <form method="POST" action="{{ route('drivers.destroy', $driver) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 font-medium">
                                            Sil
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $canManage ? 8 : 7 }}" class="px-6 py-12 text-center text-gray-400 text-sm">
                            Kayıtlı sürücü bulunamadı.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($drivers->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $drivers->links() }}
        </div>
    @endif
</div>

@endsection
