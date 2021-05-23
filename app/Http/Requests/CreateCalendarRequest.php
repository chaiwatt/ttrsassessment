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
            'fulltbp' => 'required',
            'eventdate' => 'required',
            'eventtimestart' => 'required',
            'eventtimeend' => 'required',
            'place' => 'required',
            'subject' => 'required',
            'summary' => 'required',
            'users' => 'required',
        ];
    }
    public function messages()
    {
      return  [
            'fulltbp.required' => 'ยังไม่ได้เลือกโครงการ',
            'eventdate.required' => 'ยังไม่ได้กรอกวันที่',
            'eventtimestart.required' => 'ยังไม่ได้กรอกเวลาเริ่ม',
            'eventtimeend.required' => 'ยังไม่ได้กรอกเวลาสิ้นสุด',
            'place.required' => 'ยังไม่ได้กรอกสถานที่',
            'subject.required' => 'ยังไม่ได้กรอกหัวข้อ',
            'summary.required' => 'ยังไม่ได้กรอกรายละเอียด',
            'users.required' => 'ยังไม่ได้เลือกผู้เข้าร่วม',
      ]; 
    }
}
