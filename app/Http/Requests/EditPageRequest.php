<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPageRequest extends FormRequest
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
            'description' => 'required',
            'pagecategory' => 'required',
            'feature' => 'image|mimes:jpeg,png,jpg|max:1024',  //1024 = 1MB
            'content' => 'required',
            
        ];
    }
    public function messages()
    {
      return  [
        'title.required' => 'ยังไม่ได้กรอกหัวเรื่อง',
        'description.required' => 'ยังไม่ได้กรอกคำอธิบายย่อ',
        'pagecategory.required' => 'ยังไม่ได้กรอกหมวดหมู่',
        'feature.image' => 'กรุณาเลือกไฟล์รูป', 
        'feature.mimes' => 'รองรับเฉพาะไฟล์รูปเท่านั้น',
        'feature.max' => 'ขนาดไฟล์มากกว่า 1 MB',
        'content.required' => 'ยังไม่ได้กรอกข้อความที่2 (ภาษาอังกฤษ)',
      ]; 
    }
}
