<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoteCustomerRequest extends FormRequest
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
            'name' => 'required|max:255 ',
            'address' => 'required|max:255 ',
            'avatar' => 'required|image|max:2048 ',
            'phone' => 'required|string|max:20|unique:customers,phone',
            'email' => 'required|email|max:255 ',
            'is_active' => 'nullable|in:0,1',
        ];
    }
}
