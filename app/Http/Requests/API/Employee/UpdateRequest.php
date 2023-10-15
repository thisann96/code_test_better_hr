<?php

namespace App\Http\Requests\API\Employee;

use App\Actions\ValidatorHelper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        (new ValidatorHelper())->handle([
            'id' => ['required','numeric'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:employees,email,' . $this->id],
            'phone' => ['required', 'string', 'unique:employees,phone,' . $this->id],
            'address' => ['nullable', 'string', 'max:255'],
            'salary' => ['required', 'numeric'],
        ]);

        return [
            //
        ];
    }
}
