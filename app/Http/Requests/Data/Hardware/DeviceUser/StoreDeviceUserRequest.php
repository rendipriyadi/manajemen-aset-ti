<?php

namespace App\Http\Requests\Data\Hardware\DeviceUser;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeviceUserRequest extends FormRequest
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
            'device_pc_id' => [
                'required',
            ],
            'device_monitor_id' => [
                'required',
            ],
            'device_additional_id' => [
                'required',
            ],
            'location_id' => [
                'required',
            ],
        ];
    }
}
