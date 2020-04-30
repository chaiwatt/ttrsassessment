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
            'pagecategory' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'pagecategory.required' => 'ยังไม่ได้กรอกหมวดหมู่'
      ]; 
    }
}
