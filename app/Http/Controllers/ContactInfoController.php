<?php

namespace App\Http\Controllers;

use App\Model\ContactInfo;
use Illuminate\Http\Request;
use App\Http\Requests\CreateContactInfoRequest;

class ContactInfoController extends Controller
{
    public function AddContact(CreateContactInfoRequest $request){
        $contactinfo = new ContactInfo();
        $contactinfo->name = $request->name;
        $contactinfo->email = $request->email;
        $contactinfo->subject = $request->subject;
        $contactinfo->message = $request->message;
        $contactinfo->save();
        return redirect()->back()->withSuccess('ขอบคุณ เราได้รับข้อความแล้ว');
    }
}
