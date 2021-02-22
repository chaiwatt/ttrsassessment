<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAnnounceRequest extends FormRequest
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
            'announcecategory' => 'required',
            'title' => 'required',
            'content' => 'required',
        ];
    }
    public function messages()
    {
      return  [
            'announcecategory.required' => 'ยังไม่ได้เลือกหมวดประกาศ',
            'title.required' => 'ยังไม่ได้กำหนดหัวข้อประกาศ',
            'content.required' => 'ยังไม่ได้เพิ่มรายละเอียดประกาศ'
      ]; 
    }
}
