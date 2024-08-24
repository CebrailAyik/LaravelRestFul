<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
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
            'company_id' => 'required|exists:companies,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'phone' => 'nullable|string|max:15',
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.required' => 'Şirket id alanı boş bırakılamaz.',
            'company_id' => 'Şirket kaydı bulunamadı lütfen geçerli bir şirket id giriniz.',
            'first_name.required' => 'Ad alanı boş bırakılamaz.',
            'first_name.max' => 'Ad alanı en fazla 255 karakterden oluşmalıdır.',
            'last_name.required' => 'Soyad alanı boş bırakılamaz.',
            'last_name.max' => 'Soyad alanı en fazla 255 karakterden oluşmalıdır.',
            'email.required' => 'E-posta alanı boş bırakılamaz.',
            'email.unique' => 'Bu e-posta adresi daha önce kullanılmış.',
            'phone.string' => 'Telefon alanı en fazla 15 karater olabilir.',
        ];
    }
}
