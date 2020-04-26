<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRegisteredCapitalType extends FormRequest
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
            'name' => 'required',
            'detail' => 'required',
            'min' => 'required',
            'max' => 'required'

        ];
    }
    public function messages()
    {
      return  [
            'registeredcapitaltype.required' => 'ยังไม่ได้รายการจดทะเบียน'
      ]; 
    }
}
