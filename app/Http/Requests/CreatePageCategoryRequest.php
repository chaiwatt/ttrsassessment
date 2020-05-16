<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePageCategoryRequest extends FormRequest
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
            'category' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'category.required' => 'ยังไม่ได้กรอกหมวดหมู่'
      ]; 
    }
}
