<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCommentRequest extends FormRequest
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
            'comment' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'comment.required' => 'ยังไม่ได้กรอกความเห็น'
      ]; 
    }
}
