<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditWebsiteSlideRequest extends FormRequest
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
            'slidestatus' => 'required',
            'slidestyle' => 'required',
        ];
    }
    public function messages()
    {
      return  [
            'slidestatus.required' => 'ยังไม่ได้เลือกสถานะการแสดง',
            'slidestyle.required' => 'ยังไม่ได้เลือกสไตล์',
      ]; 
    }
}
