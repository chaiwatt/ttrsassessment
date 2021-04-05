<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            // 'prefix' => 'required',
            // 'name' => 'required',
            // 'lastname' => 'required',
            'usertype' => 'required',
            // 'email' => 'required',
            // 'password' => 'required',
            'userstatus' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            // 'prefix.required' => 'ยังไม่ได้กรอกคำนำหน้า',
            // 'name.required' => 'ยังไม่ได้กรอกชื่อ',
            // 'lastname.required' => 'ยังไม่ได้กรอกนามสกุล',
            'usertype.required' => 'ยังไม่ได้เลือกกลุ่มผู้ใช้',
            // 'email.required' => 'ยังไม่ได้กรอกอีเมล',
            // 'password.required' => 'ยังไม่ได้กรอกรหัสผ่าน',
            'userstatus.required' => 'ยังไม่ได้เลือกสถานะการใช้งาน',
      ]; 
    }
}
