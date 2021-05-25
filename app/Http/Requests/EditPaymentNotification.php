<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPaymentNotification extends FormRequest
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
            'price' => 'required',
            'paymentdate' => 'required',
            'paymenttime' => 'required',
            'file' => 'required',
        ];
    }
    public function messages()
    {
      return  [
        'price.required' => 'ยังไม่ได้กรอกจำนวนเงิน (บาท)',
        'paymentdate.required' => 'ยังไม่ได้เลือกวันที่ชำระเงิน',
        'paymenttime.required' => 'ยังไม่ได้กรอกเวลาชำระเงิน',
        'file.required' => 'ยังไม่ได้แนบไฟล์',
      ]; 
    }
}
