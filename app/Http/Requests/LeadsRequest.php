<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadsRequest extends FormRequest
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

    public function attributes()
    {
        return [
            'client' => 'Клиент',
            'cargo' => 'Груз',
            'ktk_prefix' => 'КТК префикс',
            'ktk_num' => 'КТК номер',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
//    public function rules()
//    {
//        return [
//            'client' => 'required',
//            'cargo' => 'required',
//            'ktk_prefix' => 'required',
//            'ktk_num' => 'required',
//        ];
//    }
}
