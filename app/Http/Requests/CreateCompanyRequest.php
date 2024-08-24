<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
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
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:companies',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'website' => 'nullable|url',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ad alanı boş bırakılamaz.',
            'name.max' => 'Ad alanı en fazla 255 karakterden oluşmalıdır.',
            'email.required' => 'E-posta alanı boş bırakılamaz.',
            'email.unique' => 'Bu e-posta adresi daha önce kullanılmış.',
            'logo' => 'Logo formatı jpeg,png,jpg,gif,svg.',
        ];
    }
}
