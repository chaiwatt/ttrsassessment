<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateWebsiteSlideRequest extends FormRequest
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
            'picture' => 'required',
            'picture' => 'image|mimes:jpeg,png,jpg|max:1024'  //1024 = 1MB
        ];
    }
    public function messages()
    {
      return  [
            'slidestatus.required' => 'ยังไม่ได้เลือกสถานะการแสดง',
            'slidestyle.required' => 'ยังไม่ได้เลือกสไตล์',
            'picture.required' => 'ยังไม่ได้เลือกรูป',
            'picture.image' => 'กรุณาเลือกไฟล์รูป',
            'picture.mimes' => 'รองรับเฉพาะไฟล์ jpeg png หรือ jpg เท่านั้น',
            'picture.max' => 'ขนาดไฟล์มากกว่า 1 MB'
      ]; 
    }
}
