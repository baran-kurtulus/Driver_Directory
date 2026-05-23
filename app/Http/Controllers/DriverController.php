<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Driver;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Driver::class, 'driver');
    }

    public function index(Request $request): View
    {
        $drivers = Driver::query()
            ->ofStatus($request->input('status'))
            ->ofVehicleType($request->input('vehicle_type'))
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        return view('drivers.index', [
            'drivers' => $drivers,
            'statuses' => Driver::STATUSES,
            'vehicleTypes' => Driver::VEHICLE_TYPES,
            'filters' => $request->only(['status', 'vehicle_type']),
        ]);
    }

    public function create(): View
    {
        return view('drivers.create', [
            'statuses' => Driver::STATUSES,
            'vehicleTypes' => Driver::VEHICLE_TYPES,
        ]);
    }

    public function store(StoreDriverRequest $request): RedirectResponse
    {
        Driver::create($request->validated());

        return redirect()
            ->route('drivers.index')
            ->with('success', 'Sürücü başarıyla eklendi.');
    }

    public function edit(Driver $driver): View
    {
        return view('drivers.edit', [
            'driver' => $driver,
            'statuses' => Driver::STATUSES,
            'vehicleTypes' => Driver::VEHICLE_TYPES,
        ]);
    }

    public function update(UpdateDriverRequest $request, Driver $driver): RedirectResponse
    {
        $driver->update($request->validated());

        return redirect()
            ->route('drivers.index')
            ->with('success', 'Sürücü başarıyla güncellendi.');
    }

    public function destroy(Driver $driver): RedirectResponse
    {
        $driver->delete();

        return redirect()
            ->route('drivers.index')
            ->with('success', 'Sürücü başarıyla silindi.');
    }
}
