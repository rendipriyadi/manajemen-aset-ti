<?php

namespace App\Http\Requests\Data\Hardware\DevicePc;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDevicePcRequest extends FormRequest
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
            'motherboard_id' => [
                'required',
            ],
            'processor_id' => [
                'required',
            ],
            'hardisk_id' => [
                'required',
            ],
            'ram_id' => [
                'required',
            ],
            'no_asset' => [
                'required',
            ],
            'name' => [
                'required',
            ],
        ];
    }
}
