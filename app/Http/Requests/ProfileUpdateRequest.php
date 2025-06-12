<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),],
                'gender' => ['required', 'in:M,F,O'],
                'nif' => ['nullable', 'regex:/^\d{9}$/'],
                'default_delivery_address' => ['nullable', 'string', 'max:255'],
                'default_payment_type' => ['nullable', 'in:Visa,PayPal,MB WAY'],
                'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10240'],
                'photo_file' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
