<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePageStatusRequest extends FormRequest
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

    public function rules()
    {
        return [
            'pagestatus' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'pagestatus.required' => 'ยังไม่ได้กรอกสถานะการแสดงเพจ'
      ]; 
    }
}
