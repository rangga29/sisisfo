<?php

namespace App\Http\Requests\Siproblem;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nik' => ['required', 'string'],
            'password' => ['required', 'string']
        ];
    }

    public function authenticate(): void
    {
        if (!Auth::attempt($this->only('nik', 'password'), $this->filled('remember'))) {;

            throw ValidationException::withMessages([
                'nik' => 'NIK DAN PASSWORD TIDAK SESUAI',
            ]);
        }
    }
}
