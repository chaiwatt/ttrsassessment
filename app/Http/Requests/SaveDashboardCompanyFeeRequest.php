<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveDashboardCompanyFeeRequest extends FormRequest
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
            'paymenttype' => 'required',
            'bankaccount' => 'required',
            'paymentdate' => 'required',
            'paymenttime' => 'required',
        ];
    }
    public function messages()
    {
      return  [
            'paymenttype.required' => 'ยังไม่ได้เลือกวิธีการชำระเงิน',
            'bankaccount.required' => 'ยังไม่ได้เลือกบัญชี',
            'paymentdate.required' => 'ยังไม่ได้กรอกวันที่ชำระเงิน',
            'paymenttime.required' => 'ยังไม่ได้กรอกเวลาที่ชำระเงิน'
      ]; 
    }
}
