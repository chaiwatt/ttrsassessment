<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        //usergroup 1=นิติบุคคล, 2=บุคลลธรรมดา
        return [
            'company' => 'required_if:usergroup,==,1',
            'name' => 'required',
            'lastname' => 'required',
            'hid' => 'required_if:usergroup,==,2|digits_between:13,13|numeric',
            'vatno' => 'required_if:usergroup,==,1',
            'registeredyear' => [
                                    'required_if:usergroup,==,1'
                                ],
            'registeredcapital' => 'required_if:usergroup,==,1,numeric,between:0,100000000000000',
            'paidupcapital' => 'required_if:usergroup,==,1',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'authorizeddirector' => 'required|not_in:0',
        ];
    }
    public function messages()
    {
      return  [
            'company.required_if' => 'ยังไม่ได้กรอกชื่อนิติบุคคล',
            'name.required' => 'ยังไม่ได้กรอกชื่อ',
            'lastname.required' => 'ยังไม่ได้กรอกนามสกุล',
            'hid.required_if' => 'ยังไม่ได้กรอกหมายเลขบัตรประจำตัวประชาชน',
            'hid.digits_between' => 'รูปแบบหมายเลขบัตรประจำตัวประชาชนไม่ถูกต้อง',
            'hid.numeric' => 'รูปแบบหมายเลขบัตรประชาชนไม่ถูกต้อง',
            'vatno.required_if' => 'ยังไม่ได้กรอกเลขทะเบียนนิติบุคคล',
            'registeredyear.required_if' => 'ยังไม่ได้กรอกปีที่จดทะเบียน',
            'registeredyear.numeric' => 'รูปแบบปีที่จดทะเบียนไม่ถูกต้อง',
            'registeredyear.between' => 'ปีที่จดทะเบียนต้องอยู่ระหว่าง พ.ศ. 2200 - 2700 เท่านั้น',
            'registeredcapital.required_if' => 'ยังไม่ได้กรอกทุนจดทะเบียน',
            'registeredcapital.numeric' => 'ทุนจดทะเบียนไม่ถูกต้อง',
            'registeredcapital.between' => 'ทุนจดทะเบียนต้องอยู่ในช่วง 0 - 100000000000000',
            'paidupcapital.required_if' => 'ยังไม่ได้กรอกทุนจดทะเบียนที่เรียกชำระแล้ว',
            'phone.required' => 'ยังไม่ได้กรอกเบอร์โทรศัพท์',
            'email.required' => 'ยังไม่ได้กรอกอีเมล',
            'address.required' => 'ยังไม่ได้กรอกที่อยู่',
            'authorizeddirector.required' => 'ยังไม่ได้เพิ่มรายชื่อกรรมการ/ผู้มีอำนาจลงนาม',
            'authorizeddirector.not_in' => 'ยังไม่ได้เพิ่มรายชื่อกรรมการ/ผู้มีอำนาจลงนาม',
      ]; 
    }
}
