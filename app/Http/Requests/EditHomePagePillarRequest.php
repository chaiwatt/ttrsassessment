<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditHomePagePillarRequest extends FormRequest
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
            'headerthai' => 'required',
            'headereng' => 'required',
            'descriptionthai' => 'required',
            'descriptioneng' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'headerthai.required' => 'ยังไม่ได้กรอก title',
            'headereng.required' => 'ยังไม่ได้กรอก title ภาษาอังกฤษ',
            'descriptionthai.required' => 'ยังไม่ได้กรอก description',
            'descriptioneng.required' => 'ยังไม่ได้กรอก description ภาษาอังกฤษ'
      ]; 
    }
}
