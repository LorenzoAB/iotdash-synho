<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SensoryFormRequest extends FormRequest
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
            'sensory1' => [
                'required',
                'string'
            ],
            'sensory2' => [
                'required',
                'string'
            ],
            'sensory3' => [
                'required',
                'string'
            ],
            'sensory4' => [
                'required',
                'string'
            ],
            'sensory5' => [
                'required',
                'string'
            ],
        ];
    }
}
