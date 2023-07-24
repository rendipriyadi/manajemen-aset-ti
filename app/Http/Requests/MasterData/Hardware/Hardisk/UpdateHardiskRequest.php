<?php

namespace App\Http\Requests\MasterData\Hardware\Hardisk;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHardiskRequest extends FormRequest
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
            'name' => [
                'required', 'string', 'max:255',
            ],
            'size' => [
                'required', 'string', 'max:255',
            ],
        ];
    }
}
