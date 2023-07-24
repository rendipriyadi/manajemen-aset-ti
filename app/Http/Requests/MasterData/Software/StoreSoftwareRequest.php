<?php

namespace App\Http\Requests\MasterData\Software;

use Illuminate\Foundation\Http\FormRequest;

class StoreSoftwareRequest extends FormRequest
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
            'software_name' => [
                'required',
            ],
            'software_category' => [
                'required',
            ]
        ];
    }
}
