<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveFrontPageRequest extends FormRequest
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
            'bgcolor' => 'required',
            'percent' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'bgcolor.required' => 'ยังไม่ได้กรอกสีพื้น',
            'percent.required' => 'ยังไม่ได้กรอกเปอร์เซนต์'
      ]; 
    }
}
