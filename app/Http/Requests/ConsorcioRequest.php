<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsorcioRequest extends FormRequest
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
            'descricao' => 'required',
            'num_participantes' => 'integer|required'
        ];
    }
}
