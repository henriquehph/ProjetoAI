<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       if (strtolower($this->getMethod()) == 'post') {
        
            return $this->user()->can('create', \App\Models\Category::class);
        } else {
            return $this->user()->can('update', $this->route('category'));
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

        $this->route('category');

        return [  
            'name' => ['required', 'string', 'max:255'],
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