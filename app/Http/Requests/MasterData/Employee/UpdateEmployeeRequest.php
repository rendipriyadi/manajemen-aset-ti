<?php

namespace App\Http\Requests\MasterData\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nip' => [
                'required', 'string', 'max:255',
            ],
            'name' => [
                'required', 'string', 'max:255', Rule::unique('employee')->ignore($this->employee),
            ],
            'job_position' => [
                'required', 'string', 'max:255',
            ],
            'division_id' => [
                'required', 'string', 'max:255',
            ],
            'department_id' => [
                'required', 'string', 'max:255',
            ],
            'section_id' => [
                'required', 'string', 'max:255',
            ],
        ];
    }
}
