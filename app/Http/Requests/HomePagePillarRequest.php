<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomePagePillarRequest extends FormRequest
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
            'textth1' => 'required',
            'texteng1' => 'required',
            'textth2' => 'required',
            'texteng2' => 'required',
            'pillartitleth1' => 'required',
            'pillartitleeng1' => 'required',
            'pillartitleth2' => 'required',
            'pillartitleeng2' => 'required',
            'pillartitleth3' => 'required',
            'pillartitleeng3' => 'required',
            'pillartitleth4' => 'required',
            'pillartitleeng4' => 'required',
            'pillardescth1' => 'required',
            'pillardesceng1' => 'required',
            'pillardescth2' => 'required',
            'pillardesceng2' => 'required',
            'pillardescth3' => 'required',
            'pillardesceng3' => 'required',
            'pillardescth4' => 'required',
            'pillardesceng4' => 'required',
        ];
    }
    public function messages()
    {
      return  [
            'textth1.required' => 'ยังไม่ได้กรอกข้อความที่ 1 (ภาษาไทย)',
            'texteng1.required' => 'ยังไม่ได้กรอกข้อความที่ 1 (ภาษาอังกฤษ)',
            'textth2.required' => 'ยังไม่ได้กรอกข้อความที่ 2 (ภาษาไทย)',
            'texteng2.required' => 'ยังไม่ได้กรอกข้อความที่ 2 (ภาษาอังกฤษ)',
            'pillartitleth1.required' => 'ยังไม่ได้กรอก Title Pillar1 (ภาษาไทย)',
            'pillartitleeng1.required' => 'ยังไม่ได้กรอก Title Pillar1 (ภาษาอังกฤษ)',
            'pillartitleth2.required' => 'ยังไม่ได้กรอก Title Pillar2 (ภาษาไทย)',
            'pillartitleeng2.required' => 'ยังไม่ได้กรอก Title Pillar2 (ภาษาอังกฤษ)',
            'pillartitleth3.required' => 'ยังไม่ได้กรอก Title Pillar3 (ภาษาไทย)',
            'pillartitleeng3.required' => 'ยังไม่ได้กรอก Title Pillar3 (ภาษาอังกฤษ)',
            'pillartitleth4.required' => 'ยังไม่ได้กรอก Title Pillar4 (ภาษาไทย)',
            'pillartitleeng4.required' => 'ยังไม่ได้กรอก Title Pillar4 (ภาษาอังกฤษ)',
            'pillardescth1.required' => 'ยังไม่ได้กรอก Description Pillar1 (ภาษาไทย)',
            'pillardesceng1.required' => 'ยังไม่ได้กรอก Description Pillar1 (ภาษาอังกฤษ)',
            'pillardescth2.required' => 'ยังไม่ได้กรอก Description Pillar2 (ภาษาไทย)',
            'pillardesceng2.required' => 'ยังไม่ได้กรอก Description Pillar2 (ภาษาอังกฤษ)',
            'pillardescth3.required' => 'ยังไม่ได้กรอกข้อ Description Pillar3 (ภาษาไทย)',
            'pillardesceng3.required' => 'ยังไม่ได้กรอกข้อ Description Pillar3 (ภาษาอังกฤษ)',
            'pillardescth4.required' => 'ยังไม่ได้กรอก Description Pillar4 (ภาษาไทย)',
            'pillardesceng4.required' => 'ยังไม่ได้กรอก Description Pillar4 (ภาษาอังกฤษ)',
      ]; 
    }
}
