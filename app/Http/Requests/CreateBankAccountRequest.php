<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBankAccountRequest extends FormRequest
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
            'bank' => 'required',
            'name' => 'required',
            'accountno' => 'required',
            'banktypeid' => 'required'
        ];
    }
    public function messages()
    {
      return  [
            'bank.required' => 'ยังไม่ได้กรอกธนาคาร',
            'name.required' => 'ยังไม่ได้กรอกชื่อบัญชี',
            'accountno.required' => 'ยังไม่ได้กรอกหมายเลขบัญชี',
            'banktypeid.required' => 'ยังไม่ได้กรอกประเภทบัญชี'
      ]; 
    }
}
