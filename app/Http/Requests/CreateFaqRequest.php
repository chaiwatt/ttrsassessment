<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFaqRequest extends FormRequest
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
            'title' => 'required',
            'body' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'title.required' => 'ยังไม่ได้กรอกคำถาม',
            'body.required' => 'ยังไม่ได้กรอกคำตอบ'
      ]; 
    }
}
