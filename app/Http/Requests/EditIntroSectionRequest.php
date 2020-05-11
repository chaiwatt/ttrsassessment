<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditIntroSectionRequest extends FormRequest
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
            'textone' => 'required',
            'textoneeng' => 'required',
            'texttwo' => 'required',
            'texttwoeng' => 'required',
        ];
    }
    public function messages()
    {
      return  [
        'textone.required' => 'ยังไม่ได้กรอกข้อความที่1 (ภาษาไทย)',
        'textoneeng.required' => 'ยังไม่ได้กรอกข้อความที่1 (ภาษาอังกฤษ)',
        'texttwo.required' => 'ยังไม่ได้กรอกข้อความที่2 (ภาษาไทย)',
        'texttwoeng.required' => 'ยังไม่ได้กรอกข้อความที่2 (ภาษาอังกฤษ)',
      ]; 
    }
}
