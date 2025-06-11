<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       if (strtolower($this->getMethod()) == 'post') {
        
            return $this->user()->can('create', \App\Models\User::class);
        } else {
            return $this->user()->can('update', $this->route('user'));
        }
    }
    /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string,
   \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    */
    public function rules(): array
    {

        $this->route('user');

        return [
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->route('user')),
            ],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'gender' => ['required', 'in:M,F,O'],
            'nif' => ['nullable', 'regex:/^\d{9}$/'],
            'default_delivery_address' => ['nullable', 'string', 'max:255'],
            'default_payment_type' => ['nullable', 'in:Visa,PayPal,MB WAY'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10240'],
            'type' => ['required', 'in:pending_member,board,member,employee'],
            'blocked' => ['required', 'in:0,1'],
            'photo_file' => 'nullable|image|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
        ];
    }
}