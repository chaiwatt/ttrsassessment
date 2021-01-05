<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Model\Company;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    use VerifiesEmails;

    // protected $redirectTo = '/dashboard/company/report'; //RouteServiceProvider::HOME;

    public function show(Request $request)
    {
        if ($request->user()->hasVerifiedEmail() == 1){
            if($request->user()->user_type_id >= 4){
                return redirect()->route('dashboard.admin.report'); 
            }else if($request->user()->user_type_id == 3){
                return redirect()->route('dashboard.expert.report'); 
            }else if($request->user()->user_type_id <= 2){
                $businessplans = BusinessPlan::where('company_id',Company::where('user_id',$request->user()->id)->first()->id)->get();
                return redirect()->route('dashboard.company.report')->withBusinessplans($businessplans); 
            }
        }else{
            return view('auth.verify');
        }
    }
    public function verify(Request $request)
    {
        Auth::user()->update([
            'email_verified_at' => Carbon::now()->toDateString()
        ]);
        Auth::logout();
        Session::flush();
        return redirect()->route('login')->withSuccess('ยืนยันอีเมลสำเร็จ');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
