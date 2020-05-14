<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'picture' => 'image|mimes:jpeg,png,jpg|max:512' //512 = 0.5MB
        ];
    }
    public function messages()
    {
      return  [
            'picture.image' => 'กรุณาเลือกไฟล์รูป',
            'picture.mimes' => 'รองรับเฉพาะไฟล์ jpeg png หรือ jpg เท่านั้น',
            'picture.max' => 'ขนาดไฟล์มากกว่า 0.5 MB',
      ]; 
    }
}
