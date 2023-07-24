<?php

namespace App\Http\Requests\Data\Hardware\DeviceMore;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeviceMoreRequest extends FormRequest
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
            'type_device_id' => [
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
