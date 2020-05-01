<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserPositionRequest extends FormRequest
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
            'userposition' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'userposition.required' => 'ยังไม่ได้กรอกตำแหน่งผู้ใช้งาน'
      ]; 
    }
}
