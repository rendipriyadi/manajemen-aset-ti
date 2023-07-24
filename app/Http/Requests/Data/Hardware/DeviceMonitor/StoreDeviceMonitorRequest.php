<?php

namespace App\Http\Requests\Data\Hardware\DeviceMonitor;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeviceMonitorRequest extends FormRequest
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
            'no_asset' => [
                'required',
            ],
            'name' => [
                'required',
            ],
            'size' => [
                'required',
            ],
        ];
    }
}
