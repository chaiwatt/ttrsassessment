<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomePageServiceCreateRequest extends FormRequest
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
            'titlethai' => 'required',
            'titleeng' => 'required',
            'descriptionthai' => 'required',     
            'descriptioneng' => 'required',  
            'link' => 'required', 
            'cardcolor' => 'required', 
            'iconnormal' => 'required',  
            'iconhover' => 'required',  
             
             
        ];
    }
    public function messages()
    {
      return  [
            'titlethai.required' => 'ยังไม่ได้กรอกข้อความ (ภาษาไทย)',
            'titleeng.required' => 'ยังไม่ได้กรอกข้อความ (ภาษาอังกฤษ)',
            'descriptionthai.required' => 'ยังไม่ได้กรอกข้อความอธิบาย (ภาษาไทย)',
            'descriptioneng.required' => 'ยังไม่ได้กรอกข้อความอธิบาย (ภาษาอังกฤษ)',
            'link.required' => 'ยังไม่ได้กรอกลิงก์',
            'cardcolor.required' => 'ยังไม่ได้เลือกสีพื้น',
            'iconnormal.required' => 'ยังไม่ได้เลือก Icon ปกติ',
            'iconhover.required' => 'ยังไม่ได้เลือก Icon Hover',
           
            
      ]; 
    }
}


