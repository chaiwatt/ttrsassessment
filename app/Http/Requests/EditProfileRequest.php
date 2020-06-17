<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'lastname' => 'required',
            'hid' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'picture' => 'image|mimes:jpeg,png,jpg|max:512' //512 = 0.5MB
        ];
    }
    public function messages()
    {
      return  [
            'name.required' => 'ยังไม่ได้กรอกชื่อ',
            'lastname.required' => 'ยังไม่ได้กรอกนามสกุล',
            'hid.required' => 'ยังไม่ได้กรอกเลขบัตรประชาชน',
            'phone.required' => 'ยังไม่ได้กรอกเบอร์โทรศัพท์',
            'address.required' => 'ยังไม่ได้กรอกที่อยู่',
            'picture.image' => 'กรุณาเลือกไฟล์รูป',
            'picture.mimes' => 'รองรับเฉพาะไฟล์ jpeg png หรือ jpg เท่านั้น',
            'picture.max' => 'ขนาดไฟล์มากกว่า 0.5 MB',
      ]; 
    }
}
