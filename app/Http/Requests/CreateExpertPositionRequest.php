<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateExpertPositionRequest extends FormRequest
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
            'expertposition' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'expertposition.required' => 'ยังไม่ได้กรอกตำแหน่ง expert'
      ]; 
    }
}
