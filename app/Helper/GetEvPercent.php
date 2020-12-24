<?php
namespace App\Helper;

use App\Model\Ev;
use App\Model\Scoring;
use App\Model\CriteriaTransaction;

class GetEvPercent
{
    public static function getEvPercent($userid,$fulltbpid){
        $ev = Ev::where('full_tbp_id',$fulltbpid)->first();
        if(Empty($ev)){
            return 0;
        }
        $criteriatransactions = CriteriaTransaction::where('ev_id',$ev->id)->get();
        if($criteriatransactions->count() == 0){
            return 0;
        }else{
            $getscore = 0;
            foreach ($criteriatransactions as $key => $criteriatransaction) {
                $userscore = Scoring::where('criteria_transaction_id',$criteriatransaction->id)->where('user_id',$userid)->first();
                $finalscore = Scoring::where('criteria_transaction_id',$criteriatransaction->id)->whereNull('user_id')->first();
                if(!Empty($userscore) && !Empty($finalscore)){
                    if($userscore->score == $finalscore->score){
                        $getscore++;
                    }
                }else if(Empty($userscore) && Empty($finalscore)){
                    $getscore++;
                }
            }
            return ($getscore/$criteriatransactions->count())*100;
        }
    } 
}
