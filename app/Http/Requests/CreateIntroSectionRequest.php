<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateIntroSectionRequest extends FormRequest
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
            'textone' => 'required',
            'texttwo' => 'required',
            'picture' => 'required|image|mimes:png|max:512'  //512 = 0.5MB
        ];
    }
    public function messages()
    {
      return  [
        'textone.required' => 'ยังไม่ได้กรอกข้อความที่1',
        'texttwo.required' => 'ยังไม่ได้กรอกข้อความที่2',
        'picture.required' => 'ยังไม่ได้เลือกรูปไอคอน',
        'picture.image' => 'กรุณาเลือกไฟล์รูป',
        'picture.mimes' => 'รองรับเฉพาะไฟล์ png เท่านั้น',
        'picture.max' => 'ขนาดไฟล์มากกว่า 0.5 MB'
      ]; 
    }
}
