<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluationResultEdit extends FormRequest
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
            'headercode' => 'required',
            'contactname' => 'required',
            'contactlastname' => 'required',
            'contactposition' => 'required',
            'contactphone' => 'required',
            'contactphoneext' => 'required',
            'contactfax' => 'required',
            'contactemail' => 'required',        
            'management' => 'required',
            'technoandinnovation' => 'required',
            'marketability' => 'required',
            'businessprospect' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'headercode.required' => 'ยังไม่ได้กรอกรหัสหน่วยงาน',
            'contactname.required' => 'ยังไม่ได้กรอกชื่อ',
            'contactlastname.required' => 'ยังไม่ได้กรอกนามสกุล',
            'contactposition.required' => 'ยังไม่ได้กรอกตำแหน่ง',
            'contactphone.required' => 'ยังไม่ได้กรอกเบอร์โทรศัพท์',
            'contactphoneext.required' => 'ยังไม่ได้กรอกเบอร์ต่อ',
            'contactfax.required' => 'ยังไม่ได้กรอกโทรสาร',
            'contactemail.required' => 'ยังไม่ได้กรอกอีเมล',
            'management.required' => 'ยังไม่ได้กรอกบทวิเคราะห์ Management',
            'technoandinnovation.required' => 'ยังไม่ได้กรอกบทวิเคราะห์ Technology',
            'marketability.required' => 'ยังไม่ได้กรอกบทวิเคราะห์ Marketability',
            'businessprospect.required' => 'ยังไม่ได้กรอกบทวิเคราะห์ Business Prospect',
      ]; 
    }
}
