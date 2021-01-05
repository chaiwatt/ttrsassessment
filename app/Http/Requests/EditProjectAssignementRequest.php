<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProjectAssignementRequest extends FormRequest
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
            'leader' => 'required',
            'coleader' => 'required',
            
        ];
    }
    public function messages()
    {
      return  [
        'leader.required' => 'ยังไม่ได้เลือก Leader',
        'coleader.required' => 'ยังไม่ได้เลือก CoLeader',
      ]; 
    }
}
