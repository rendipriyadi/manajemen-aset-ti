<?php

namespace App\Http\Requests\MasterData\Network;

use Illuminate\Foundation\Http\FormRequest;

class StoreIpAddressRequest extends FormRequest
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
            'start_ip' => 'required|string',
            'end_ip' => 'required|string',
            'description' => 'nullable|string'
        ];
    }
}
