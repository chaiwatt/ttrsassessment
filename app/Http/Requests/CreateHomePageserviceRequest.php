<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHomePageserviceRequest extends FormRequest
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
            'iconimg' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'titlethai.required' => 'ยังไม่ได้กรอก title',
            'titleeng.required' => 'ยังไม่ได้กรอก title ภาษาอังกฤษ',
            'descriptionthai.required' => 'ยังไม่ได้กรอก description',
            'descriptioneng.required' => 'ยังไม่ได้กรอก description ภาษาอังกฤษ',
            'iconimg.required' => 'ยังไม่ได้เลือกรูป'
      ]; 
    }
}
