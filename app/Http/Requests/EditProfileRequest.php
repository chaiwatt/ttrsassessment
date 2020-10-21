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

    // public function rules()
    // {
    //     return [
    //         'name' => 'required',
    //         'lastname' => 'required',
    //         'hid' => 'required',
    //         'phone' => 'required',
    //         'address' => 'required',
    //         'picture' => 'image|mimes:jpeg,png,jpg|max:512' //512 = 0.5MB
    //     ];
    // }
    // public function messages()
    // {
    //   return  [
    //         'name.required' => 'ยังไม่ได้กรอกชื่อ',
    //         'lastname.required' => 'ยังไม่ได้กรอกนามสกุล',
    //         'hid.required' => 'ยังไม่ได้กรอกเลขบัตรประชาชน',
    //         'phone.required' => 'ยังไม่ได้กรอกเบอร์โทรศัพท์',
    //         'address.required' => 'ยังไม่ได้กรอกที่อยู่',
    //         'picture.image' => 'กรุณาเลือกไฟล์รูป',
    //         'picture.mimes' => 'รองรับเฉพาะไฟล์ jpeg png หรือ jpg เท่านั้น',
    //         'picture.max' => 'ขนาดไฟล์มากกว่า 0.5 MB',
    //   ]; 
    // }
    public function rules()
    {
        return [
            'company' => 'required_if:usergroup,==,1',
            'vatno' => 'required_if:usergroup,==,1',
            'registeredyear' => 'required_if:usergroup,==,1',
            'registeredcapital' => 'required_if:usergroup,==,1',
            'paidupcapital' => 'required_if:usergroup,==,1',
            'industrygroup' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'province' => 'required',
            'amphur' => 'required',
            'tambol' => 'required',
            'postalcode' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'company.required_if' => 'ยังไม่ได้กรอกชื่อนิติบุคคล',
            'vatno.required_if' => 'ยังไม่ได้กรอกเลขทะเบียนนิติบุคคล',
            'registeredyear.required_if' => 'ยังไม่ได้กรอกปีที่จดทะเบียน',
            'registeredcapital.required_if' => 'ยังไม่ได้กรอกทุนจดทะเบียน',
            'paidupcapital.required_if' => 'ยังไม่ได้กรอกทุนจดทะเบียนที่เรียกชำระแล้ว',
            'industrygroup.required' => 'ยังไม่ได้เลือกกลุ่มธุรกิจ',
            'phone.required' => 'ยังไม่ได้กรอกเบอร์โทรศัพท์',
            'email.required' => 'ยังไม่ได้กรอกอีเมล',
            'address.required' => 'ยังไม่ได้กรอกที่อยู่',
            'province.required' => 'ยังไม่ได้เลือกจังหวัด',
            'amphur.required' => 'ยังไม่ได้เลือกอำเภอ',
            'tambol.required' => 'ยังไม่ได้เลือกตำบล',
            'postalcode.required' => 'ยังไม่ได้กรอกรหีสไปรษณีย์'
      ]; 
    }
}
// }
