<?php

namespace App\Http\Requests\Data\DailyActivity;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDailyActivityRequest extends FormRequest
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
            'start_date' => [
                'required',
            ],
            'work_category_id' => [
                'required', 'string', 'max:255',
            ],
            'work_type_id' => [
                'required', 'string', 'max:255',
            ],
            'activity' => [
                'required',
            ],
        ];
    }
}
