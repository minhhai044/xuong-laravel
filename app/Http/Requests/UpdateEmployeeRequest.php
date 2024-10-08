<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class UpdateEmployeeRequest extends FormRequest
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
        $id = $this->route('employee')->id;
        return [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => ['required','email',Rule::unique(Employee::class)->ignore($id)],
            'phone' => ['required','string',Rule::unique(Employee::class)->ignore($id)],
            'date_of_birth' => 'required',
            'hire_date' => 'required',
            'is_active' => 'nullable|in:0,1',
            'address' => 'required',
            'profile_picture' => 'nullable|image',
        ];
    }
}
