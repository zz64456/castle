<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderStoreRequest extends FormRequest
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
            'id' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'address' => 'required|array',
            'address.city' => 'required|string|max:100',
            'address.district' => 'required|string|max:100',
            'address.street' => 'required|string|max:255',
            'price' => 'required|numeric',
            'currency' => ['required', Rule::in(['TWD', 'USD', 'JPY', 'RMB', 'MYR'])], // 只接受指定的貨幣代碼
        ];
    }
}
