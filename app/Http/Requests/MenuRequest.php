<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'menuenglish' => 'required',
            'url' => 'required',     
        ];
    }
    public function messages()
    {
      return  [
            'menuthai.required' => 'ยังไม่ได้กรอกเมนูภาษาไทย',
            'menuenglish.required' => 'ยังไม่ได้กรอกเมนูภาษาอังกฤษ',
            'url.required' => 'ยังไม่ได้กรอกลิงก์',
      ]; 
    }
}
