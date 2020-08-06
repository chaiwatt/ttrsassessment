<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditMiniTbpRequest extends FormRequest
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
            'project' => 'required',
            'contactname' => 'required',
            'contactlastname' => 'required',
            'contactphone' => 'required',
            'contactemail' => 'required',
        ];
    }
    public function messages()
    {
      return  [
            'project.required' => 'ยังไม่ได้กรอกชื่อโครงการ',
            'contactname.required' => 'ยังไม่ได้กรอกชื่อผู้ติดต่อ',
            'contactlastname.required' => 'ยังไม่ได้กรอกนามสกุลผู้ติดต่อ',
            'contactphone.required' => 'ยังไม่ได้กรอกเบอร์โทรศัพท์ผู้ติดต่อ',
            'contactemail.required' => 'ยังไม่ได้กรอกอีเมลผู้ติดต่อเกณฑ์',
      ]; 
    }
}
