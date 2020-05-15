<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTagRequest extends FormRequest
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
            'tag_id' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'tag_id.required' => 'ยังไม่ได้กรอกป้ายชื่อกำกับเพจ'
      ]; 
    }
}
