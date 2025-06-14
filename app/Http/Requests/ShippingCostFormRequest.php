<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ShippingCostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->isMethod('post')) {
            return $this->user()->can('create', \App\Models\ShippingCost::class);
        } else {
            // Assuming your route parameter name is 'shipping_cost'
            return $this->user()->can('update', $this->route('shipping_cost'));
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

        return [
            'min_value_threshold' => ['required', 'numeric', 'min:0'],
            'max_value_threshold' => ['required', 'numeric', 'gt:min_value_threshold'],
            'shipping_cost' => ['required', 'numeric', 'min:0'],
        ];
    }
    public function messages(): array
    {
        return [
            'shipping_cost.required' => 'Name is required',
            'shipping_cost.numeric' => 'Shipping cost must be a number',
            'shipping_cost.min' => 'Shipping cost must be at least 0',
            'min_value_threshold.required' => 'Minimum value threshold is required',
            'min_value_threshold.numeric' => 'Minimum value threshold must be a number',
        ];
    }
}