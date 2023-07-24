<?php

namespace App\Http\Requests\MasterData\Location\LocationDetail;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationDetailRequest extends FormRequest
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
            'location_id' => [
                'required', 'string', 'max:255',
            ],
            'location_sub_id' => [
                'required', 'string', 'max:255',
            ],
            'location_room_id' => [
                'required', 'string', 'max:255',
            ],
        ];
    }
}
