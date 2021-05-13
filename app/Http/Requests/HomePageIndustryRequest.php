<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomePageIndustryRequest extends FormRequest
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
            'titleth' => 'required',
            'titleeng' => 'required',
            'subtitleth' => 'required',
            'subtitleeng' => 'required',
        ];
    }
    public function messages()
    {
      return  [
            'titleth.required' => 'ยังไม่ได้กรอกข้อความที่ 1 (ภาษาไทย)',
            'titleeng.required' => 'ยังไม่ได้กรอกข้อความที่ 1 (ภาษาอังกฤษ)',
            'subtitleth.required' => 'ยังไม่ได้กรอกข้อความที่ 2 (ภาษาไทย)',
            'subtitleeng.required' => 'ยังไม่ได้กรอกข้อความที่ 2 (ภาษาอังกฤษ)',
      ]; 
    }
}
