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
            'phone' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ];
    }
    public function messages()
    {
      return  [
            'name.required' => 'ยังไม่ได้กรอกชื่อ',
            'email.required' => 'ยังไม่ได้กรอกอีเมล์',
            'email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'phone.required' => 'ยังไม่ได้กรอกเบอร์โทรศัพท์',
            'message.required' => 'ยังไม่ได้กรอกข้อความ',
            'g-recaptcha-response.required' => 'โปรดตรวจสอบว่าคุณไม่ใช่หุ่นยนต์',
            'g-recaptcha-captcha.required' => 'โปรดตรวจสอบว่าคุณไม่ใช่หุ่นยนต์'
      ]; 
    }
}
