<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCountryRequest extends FormRequest
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
            'country' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'country.required' => 'ยังไม่ได้กรอกประเทศ'
      ]; 
    }
}
