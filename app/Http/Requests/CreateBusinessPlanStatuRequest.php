<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBusinessPlanStatuRequest extends FormRequest
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
            'businessplanstatus' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'businessplanstatus.required' => 'ยังไม่ได้กรอกสถานะการวางแผนธุรกิจ'
      ]; 
    }
}
