<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDriverRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, ValidationRule|string>>
     */
    public function rules(): array
    {
        $driver = $this->route('driver');

        return [
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20', Rule::unique('drivers', 'phone')->ignore($driver)],
            'license_number' => ['required', 'string', 'max:50', Rule::unique('drivers', 'license_number')->ignore($driver)],
            'vehicle_type' => ['required', 'in:sedan,suv,minivan,truck'],
            'status' => ['required', 'in:active,inactive,on_trip'],
            'email' => ['nullable', 'email', 'max:150', Rule::unique('drivers', 'email')->ignore($driver)],
            'license_expiry' => ['required', 'date', 'after:today'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Sürücü adı zorunludur.',
            'name.max' => 'Sürücü adı en fazla 100 karakter olabilir.',
            'phone.required' => 'Telefon numarası zorunludur.',
            'phone.unique' => 'Bu telefon numarası zaten kayıtlı.',
            'license_number.required' => 'Ehliyet numarası zorunludur.',
            'license_number.unique' => 'Bu ehliyet numarası zaten kayıtlı.',
            'vehicle_type.required' => 'Araç tipi seçilmelidir.',
            'vehicle_type.in' => 'Geçersiz araç tipi seçildi.',
            'status.required' => 'Durum seçilmelidir.',
            'status.in' => 'Geçersiz durum seçildi.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.unique' => 'Bu e-posta adresi zaten kayıtlı.',
            'license_expiry.required' => 'Ehliyet geçerlilik tarihi zorunludur.',
            'license_expiry.date' => 'Geçerli bir tarih giriniz.',
            'license_expiry.after' => 'Ehliyet tarihi bugünden ileri bir tarih olmalıdır.',
        ];
    }
}
