<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCompanyRequest extends FormRequest
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
            'company' => 'required',
            'businesstype' => 'required',
            'industrygroup' => 'required',
            'registeredcapitaltype' => 'required',
            'phone' => 'required',
            'fax' => 'required',
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
            'company.required' => 'ยังไม่ได้กรอกชื่อชื่อกิจการ/บริษัท',
            'businesstype.required' => 'ยังไม่ได้เลือกประเภทการจดทะเบียน',
            'industrygroup.required' => 'ยังไม่ได้เลือกกลุ่มธุรกิจ',
            'registeredcapitaltype.required' => 'ยังไม่ได้เลือกประเภททุนจดทะเบียน',
            'phone.required' => 'ยังไม่ได้กรอกเบอร์โทรศัพท์',
            'fax.required' => 'ยังไม่ได้กรอกแฟ็กซ์',
            'email.required' => 'ยังไม่ได้กรอกอีเมล์',
            'address.required' => 'ยังไม่ได้กรอกที่อยู่',
            'province.required' => 'ยังไม่ได้เลือกจังหวัด',
            'amphur.required' => 'ยังไม่ได้เลือกอำเภอ',
            'tambol.required' => 'ยังไม่ได้เลือกตำบล',
            'postalcode.required' => 'ยังไม่ได้กรอกรหีสไปรษณีย์',
      ]; 
    }
}
