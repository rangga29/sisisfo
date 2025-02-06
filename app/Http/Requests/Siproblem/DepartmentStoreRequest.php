<?php

namespace App\Http\Requests\Siproblem;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dp_code' => ['required', 'unique:departments,dp_code'],
            'dp_name' => ['required', 'unique:departments,dp_name'],
            'dp_group' => ['required'],
            'dp_spr' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'dp_code.required' => 'Kode Department Harus Diisi',
            'dp_code.unique' => 'Kode Department Sudah Digunakan',
            'dp_name.required' => 'Nama Department Harus Diisi',
            'dp_name.unique' => 'Nama Department Sudah Digunakan',
            'dp_group.required' => 'Grup Department Harus Dipilih',
            'dp_spr.required' => 'SPR Department Harus Dipilih'
        ];
    }
}
