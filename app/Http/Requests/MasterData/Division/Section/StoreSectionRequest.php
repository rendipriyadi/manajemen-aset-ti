<?php

namespace App\Http\Requests\MasterData\Division\Section;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
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
            'division_id' => [
                'required', 'string', 'max:255',
            ],
            'department_id' => [
                'required', 'string', 'max:255',
            ],
            'name' => [
                'required', 'string', 'max:255',
            ],
        ];
    }
}
