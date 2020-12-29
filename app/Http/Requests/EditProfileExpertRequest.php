<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileExpertRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'prefix' => 'required',
            'name' => 'required',
            'lastname' => 'required',
            'hid' => 'required',
            'address' => 'required',
            'province' => 'required',
            'amphur' => 'required',
            'tambol' => 'required',
            'postalcode' => 'required',
            'phone' => 'required',
            'organization' => 'required',
            'position' => 'required',
            'expereinceyear' => 'required',
            'expereincemonth' => 'required',
            'inpexpertfield' => 'required',
        ];
    }
    public function messages()
    {
      return  [
        'prefix.required' => 'ยังไม่ได้เลือกคำนำหน้า',
        'name.required' => 'ยังไม่ได้กรอกชื่อ',
        'lastname.required' => 'ยังไม่ได้กรอกนามสกุล',
        'hid.required' => 'ยังไม่ได้กรอกเลขบัตรประจำตัวประชาชน',
        'address.required' => 'ยังไม่ได้กรอกที่อยู่ตามบัตรประชาชน',
        'province.required' => 'ยังไม่ได้เลือกจังหวัด',
        'amphur.required' => 'ยังไม่ได้เลือกอำเภอ',
        'tambol.required' => 'ยังไม่ได้เลือกตำบล',
        'postalcode.required' => 'ยังไม่ได้กรอกรหัสไปรษณีย์',
        'phone.required' => 'ยังไม่ได้กรอกโทรศัพท์',
        'organization.required' => 'ยังไม่ได้กรอกหน่วยงานที่สังกัด',
        'position.required' => 'ยังไม่ได้กรอกตำแหน่ง',
        'expereinceyear.required' => 'ยังไม่ได้กรอกประสบการณ์การทำงาน (ปี)',
        'expereincemonth.required' => 'ยังไม่ได้กรอกประสบการณ์การทำงาน (เดือน)',
        'inpexpertfield.required' => 'ยังไม่ได้เพิ่มความเชี่ยวชาญ',
      ]; 
    }
}
