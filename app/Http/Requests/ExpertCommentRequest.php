<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpertCommentRequest extends FormRequest
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
            'overview' => 'required',
            'management' => 'required',
            'technology' => 'required',
            'marketing' => 'required',
            'businessprospect' => 'required'        
        ];
    }
    public function messages()
    {
      return  [
            'overview.required' => 'ยังไม่ได้กรอก Overview',
            'management.required' => 'ยังไม่ได้กรอก Management',
            'technology.required' => 'ยังไม่ได้กรอก Technology',
            'marketing.required' => 'ยังไม่ได้กรอก Marketing',
            'businessprospect.required' => 'ยังไม่ได้กรอก Businessprospect',
      ]; 
    }
}
