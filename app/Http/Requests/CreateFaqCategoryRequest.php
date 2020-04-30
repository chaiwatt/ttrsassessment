<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFaqCategoryRequest extends FormRequest
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
            'faqcategory' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'faqcategory.required' => 'ยังไม่ได้กรอกหมวดหมู่ faq'
      ]; 
    }
}
