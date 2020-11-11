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
            'gallery.*' => 'image|mimes:jpeg,png,jpg|max:1024|dimensions:min_width=1000,min_height=1000', //1024 = 1MB
            'gallery' => 'max:6'
            
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
        'gallery.image' => 'กรุณาเลือกไฟล์รูปแกลเลอรี่', 
        'gallery.mimes' => 'แกลเลอรี่รองรับเฉพาะไฟล์รูปเท่านั้น',
        'gallery.max' => 'ขนาดไฟล์แกลเลอรี่มากกว่า 1 MB',
        'gallery.dimensions' => 'ขนาดไฟล์รูปแกลเลอรี่ขั้นต่ำ 1000px x 1000px',
        'gallery.max' => 'ไฟล์รูปแกลเลอรี่อัปโหลดสูงสุด 6 ไฟล์',
      ]; 
    }
}
