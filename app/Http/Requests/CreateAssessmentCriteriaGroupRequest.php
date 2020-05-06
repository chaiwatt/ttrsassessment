<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAssessmentCriteriaGroupRequest extends FormRequest
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
            'industrygroup' => 'required',
            'criterialist' => 'required',
        ];
    }
    public function messages()
    {
      return  [
            'name.required' => 'ยังไม่ได้กรอกชื่อรายการ',
            'industrygroup.required' => 'ยังไม่ได้เลือกกลุ่มธุรกิจ',
            'criterialist.required' => 'ยังไม่ได้เลือกเกณฑ์'
      ]; 
    }
}
