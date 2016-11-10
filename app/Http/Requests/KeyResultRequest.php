<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeyResultRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'subject' => 'required',
            'description' => 'required',
            'target_value' => 'required',
            'target_unit' => 'required',
        ];
    }
}
