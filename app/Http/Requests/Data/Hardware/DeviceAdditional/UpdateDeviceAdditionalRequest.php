<?php

namespace App\Http\Requests\Data\Hardware\DeviceAdditional;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeviceAdditionalRequest extends FormRequest
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
            'no_non_asset' => [
                'required',
            ],
            'name' => [
                'required', 'string', 'max:255',
            ],
            'type_device_id' => [
                'required', 'string', 'max:255',
            ],
        ];
    }
}
