<?php

namespace App\Http\Requests\Data\Hardware;

use Illuminate\Foundation\Http\FormRequest;

class StoreExportPdfRequest extends FormRequest
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
        $attr = $this->attributes();

        return [
            'dari' => ['required', 'date', 'date_format:Y-m-d'],
            'sampai' => ['required', 'date', 'date_format:Y-m-d'],
        ];
    }

    public function attributes()
    {
        return [
            'dari' => 'Tanggal Dari',
            'sampai' => 'Tanggal Sampai',
        ];
    }
}
