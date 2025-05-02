<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Kolom :attribute masih kosong!',
            'unique' => 'Maaf, email telah digunakan!',
            'confirmed' => 'Password konfirmasi tidak sesuai.',
            'min' => 'Minimal :attribute adalah :min karakter.'
        ];
    }
}
