<?php

namespace App\Http\Requests\Data\Hardware\DeviceDivision;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeviceDivisionRequest extends FormRequest
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
                'required',
            ],
            'device_more_id' => [
                'required',
            ],
            'location_detail_id' => [
                'required',
            ],
        ];
    }
}
