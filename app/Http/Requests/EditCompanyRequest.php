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
            'company' => 'required_if:usergroup,==,1',
            'vatno' => 'required_if:usergroup,==,1',
            'registeredyear' => 'required_if:usergroup,==,1',
            'registeredcapital' => 'required_if:usergroup,==,1',
            'paidupcapital' => 'required_if:usergroup,==,1',
            'businesstype' => 'required',
            'industrygroup' => 'required',
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
            'company.required' => 'ยังไม่ได้กรอกชื่อนิติบุคคล',
            'vatno.required' => 'ยังไม่ได้กรอกเลขทะเบียนนิติบุคคล',
            'registeredyear.required' => 'ยังไม่ได้กรอกปีที่จดทะเบียน',
            'registeredcapital.required' => 'ยังไม่ได้กรอกทุนจดทะเบียน',
            'paidupcapital.required' => 'ยังไม่ได้กรอกทุนจดทะเบียนที่เรียกชำระแล้ว',
            'businesstype.required' => 'ยังไม่ได้เลือกประเภทการจดทะเบียน',
            'industrygroup.required' => 'ยังไม่ได้เลือกกลุ่มธุรกิจ',
            'phone.required' => 'ยังไม่ได้กรอกเบอร์โทรศัพท์',
            'fax.required' => 'ยังไม่ได้กรอกแฟ็กซ์',
            'email.required' => 'ยังไม่ได้กรอกอีเมล',
            'address.required' => 'ยังไม่ได้กรอกที่อยู่',
            'province.required' => 'ยังไม่ได้เลือกจังหวัด',
            'amphur.required' => 'ยังไม่ได้เลือกอำเภอ',
            'tambol.required' => 'ยังไม่ได้เลือกตำบล',
            'postalcode.required' => 'ยังไม่ได้กรอกรหีสไปรษณีย์'
      ]; 
    }
}
//'paidupcapital' => 'required_if:usergroup,==,1',