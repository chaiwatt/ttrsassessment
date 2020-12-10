<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDirectMenuRequest extends FormRequest
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
            'menuthai' => 'required',
            'menuenglish' => 'required'
        ];
    }
    public function messages()
    {
      return  [
        'menuthai.required' => 'ยังไม่ได้กรอกชื่อเมนูภาษาไทย',
        'menuenglish.required' => 'ยังไม่ได้กรอกชื่อเมนูภาษาอังกฤษ'
      ]; 
    }
}
