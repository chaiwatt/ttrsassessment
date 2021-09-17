<?php

namespace App\Http\Controllers;

use App\Model\Bol;
use App\Model\FullTbp;
use App\Model\MiniTBP;
use App\Model\PopupMessage;
use Illuminate\Http\Request;
use App\Helper\OnlyBelongPerson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardAdminProjectFullTbpBolController extends Controller
{
    public function Index($id){
        $fulltbp = FullTbp::find($id);
        $bols = Bol::where('full_tbp_id',$id)->get();
        $minitbp = MiniTBP::find($fulltbp->mini_tbp_id);
        if(OnlyBelongPerson::LeaderAndExpert($minitbp->id) == false){
            $popupmessages = PopupMessage::get();
            return view('dashboard.admin.project.fulltbp.bol.index')->withBols($bols)->withFulltbp($fulltbp)->withPopupmessages($popupmessages);
        }else{
            Auth::logout();
            Session::flush();
            return redirect()->route('login');
        }
        
    }
}
