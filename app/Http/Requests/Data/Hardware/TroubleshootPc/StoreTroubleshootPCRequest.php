<?php

namespace App\Http\Requests\Data\Hardware\TroubleshootPc;

use Illuminate\Foundation\Http\FormRequest;

class StoreTroubleshootPCRequest extends FormRequest
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
            'tgl_perbaikan' => 'required|date',
            'description' => 'required|string'
        ];
    }
}
