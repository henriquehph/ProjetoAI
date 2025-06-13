<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Category;

class ProductFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // adjust authorization logic if needed
    }

    public function rules(): array
    {
        return [
            // 'id' is not present, so not updatable through request

            'category_name' => [
                'required',
                'string',
                
                function ($attribute, $value, $fail) {
                    if (!Category::where('name', $value)->exists()) {
                        $fail("The selected category does not exist.");
                    }
                },
            ],

            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string|max:1000',
            
            'photo_file' => 'nullable|image|max:2048', // max 2MB
            
            'discount_min_qty' => 'nullable|integer|min:1',
            'discount' => 'nullable|numeric|min:0',

            'stock_lower_limit' => 'nullable|integer|min:0',
            'stock_upper_limit' => 'nullable|integer|min:0|gte:stock_lower_limit',
        ];
    }

    /**
     * Prepare the data for validation.
     * Convert category name to category_id here if you want.
     */
    protected function prepareForValidation()
    {
        if ($this->has('category')) {
            $category = Category::where('name', $this->category)->first();
            if ($category) {
                $this->merge([
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}