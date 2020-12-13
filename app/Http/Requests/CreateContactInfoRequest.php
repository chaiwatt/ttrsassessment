<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateContactInfoRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'name.required' => 'ยังไม่ได้กรอกชื่อ-สกุล',
            'email.required' => 'ยังไม่ได้กรอกอีเมล์',
            'email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'subject.required' => 'ยังไม่ได้กรอกหัวข้อ',
            'message.required' => 'ยังไม่ได้กรอกข้อความ'
      ]; 
    }
}
