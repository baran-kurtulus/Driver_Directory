<?php

namespace App\Models;

use Database\Factories\DriverFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'phone',
    'license_number',
    'vehicle_type',
    'status',
    'email',
    'license_expiry',
])]
class Driver extends Model
{
    /** @use HasFactory<DriverFactory> */
    use HasFactory;

    public const VEHICLE_TYPES = [
        'sedan' => 'Sedan',
        'suv' => 'SUV',
        'minivan' => 'Minivan',
        'truck' => 'Kamyon',
    ];

    public const STATUSES = [
        'active' => 'Aktif',
        'inactive' => 'Pasif',
        'on_trip' => 'Yolda',
    ];

    protected function casts(): array
    {
        return [
            'license_expiry' => 'date',
        ];
    }

    public function scopeOfStatus(Builder $query, ?string $status): Builder
    {
        if ($status && array_key_exists($status, self::STATUSES)) {
            return $query->where('status', $status);
        }

        return $query;
    }

    public function scopeOfVehicleType(Builder $query, ?string $vehicleType): Builder
    {
        if ($vehicleType && array_key_exists($vehicleType, self::VEHICLE_TYPES)) {
            return $query->where('vehicle_type', $vehicleType);
        }

        return $query;
    }
}
