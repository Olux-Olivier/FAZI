<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => ['required', 'max:255'],
            'categorie'=>['required'],
            'prenom' => ['required', 'max:255'],
            'telephone' => ['required', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'password' => ['required', 'min:4'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ];
    }
}
