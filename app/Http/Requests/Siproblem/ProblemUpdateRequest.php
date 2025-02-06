<?php

namespace App\Http\Requests\Siproblem;

use Illuminate\Foundation\Http\FormRequest;

class ProblemUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dp_id' => ['required'],
            'pr_ucode' => ['nullable'],
            'pr_name' => ['required', 'unique:problems,pr_name,' . $this->problem->id],
        ];
    }

    public function messages(): array
    {
        return [
            'dp_id.required' => 'Nama Department Harus Diisi',
            'pr_name.required' => 'Nama Problem Harus Diisi',
            'pr_name.unique' => 'Nama Problem Sudah Digunakan'
        ];
    }
}
