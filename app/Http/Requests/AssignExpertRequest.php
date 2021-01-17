<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignExpertRequest extends FormRequest
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
            'expert' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'expert.required' => 'ยังไม่ได้เลือกผู้เชี่ยวชาญ'
      ]; 
    }
}
