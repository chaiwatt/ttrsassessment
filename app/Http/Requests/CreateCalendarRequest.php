<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCalendarRequest extends FormRequest
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
            'eventdate' => 'required',
            'eventtimestart' => 'required',
            'eventtimeend' => 'required',
            'place' => 'required',
            'room' => 'required',
            'summary' => 'required',
            'users' => 'required',
        ];
    }
    public function messages()
    {
      return  [
            'eventdate.required' => 'ยังไม่ได้กรอกวันที่',
            'eventtimestart.required' => 'ยังไม่ได้กรอกเวลาเริ่ม',
            'eventtimeend.required' => 'ยังไม่ได้กรอกเวลาสิ้นสุด',
            'place.required' => 'ยังไม่ได้กรอกสถานที่',
            'room.required' => 'ยังไม่ได้กรอกห้อง',
            'summary.required' => 'ยังไม่ได้กรอกรายละเอียด',
            'users.required' => 'ยังไม่ได้เลือกผู้เข้าร่วม',
      ]; 
    }
}