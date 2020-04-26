<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrIndustryGroupRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'industrygroup' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'industrygroup.required' => 'ยังไม่ได้กรอกกลุ่มอุตสาหกรรม'
      ]; 
    }
}
