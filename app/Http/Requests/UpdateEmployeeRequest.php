<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $employeeId = $this->route('employee')?->id ?? $this->route('Employees')?->id;

        return [
            'name' => 'required|max:120',
            'email' => [
                'required',
                'email',
                Rule::unique('employees', 'email')->ignore($employeeId),
            ],
            'phone' => 'required',
            'unit_id' => 'required',
            'rank_id' => 'required',
            'position_id' => 'required',
            'echelon_id' => 'required',
            'religion_id' => 'required',
            'photo' => 'nullable|image|max:1048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name tidak boleh kosong',
            'name.max' => 'Name maksimal 120 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah digunakan oleh pegawai lain',
            'phone.required' => 'Phone tidak boleh kosong',
            'unit_id.required' => 'Unit tidak boleh kosong',
            'rank_id.required' => 'Rank tidak boleh kosong',
            'position_id.required' => 'Position tidak boleh kosong',
            'echelon_id.required' => 'Echelon tidak boleh kosong',
            'religion_id.required' => 'Religion tidak boleh kosong',
            'photo.image' => 'Photo harus berupa gambar',
            'photo.max' => 'Photo maksimal 1MB',
        ];
    }
}
