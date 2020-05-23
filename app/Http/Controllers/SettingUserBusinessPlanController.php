<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Company;
use App\Model\BusinessPlan;
use Illuminate\Http\Request;
use App\Model\BusinessPlanHistory;
use App\Model\BusinessPlanMarketAnalyse;
use App\Model\BusinessPlanMarketOpponent;

class SettingUserBusinessPlanController extends Controller
{
    public function Edit($userid){
        $businessplan = BusinessPlan::find(Company::where('user_id',$userid)->first()->id);
        $businessplanhistory = BusinessPlanHistory::where('business_plan_id',$businessplan->id)->first();
        $businessplanmarketanalyse = BusinessPlanMarketAnalyse::where('business_plan_id',$businessplan->id)->first();
        $businessplanmarketopponent = BusinessPlanMarketOpponent::where('business_plan_id',$businessplan->id)->first();
        return view('setting.user.businessplan.edit')->withBusinessplan($businessplan)
                                                    ->withBusinessplanhistory($businessplanhistory)
                                                    ->withBusinessplanmarketanalyse($businessplanmarketanalyse)
                                                    ->withBusinessplanmarketopponent($businessplanmarketopponent);
    }
    public function EditSave(Request $request,$id){
        $businessplan = BusinessPlan::find($id);
        $businessplanhistory = BusinessPlanHistory::where('business_plan_id',$businessplan->id)->first();
        if(Empty($businessplanhistory)){
            $businessplanhistory = new BusinessPlanHistory();
            $businessplanhistory->business_plan_id = $id;
            $businessplanhistory->establishedhistory = $request->establishedhistory;
            $businessplanhistory->concepthistory = $request->concepthistory;
            $businessplanhistory->successhistory = $request->successhistory;
            $businessplanhistory->obstaclehistory = $request->obstaclehistory;
            $businessplanhistory->save(); 
        }else{
            $businessplanhistory->update([
                'establishedhistory' => $request->establishedhistory,
                'concepthistory' => $request->concepthistory,
                'successhistory' => $request->successhistory,
                'obstaclehistory' => $request->obstaclehistory,
            ]);
        }

        $businessplanmarketanalyse = BusinessPlanMarketAnalyse::where('business_plan_id',$businessplan->id)->first();
        if(Empty($businessplanmarketanalyse)){
            $businessplanmarketanalyse = new BusinessPlanMarketAnalyse();
            $businessplanmarketanalyse->business_plan_id = $id;
            $businessplanmarketanalyse->condition = $request->condition;
            $businessplanmarketanalyse->share = $request->share;
            $businessplanmarketanalyse->trend = $request->trend;
            $businessplanmarketanalyse->tarket = $request->tarket;
            $businessplanmarketanalyse->characteristicofcustomer = $request->characteristicofcustomer;
            $businessplanmarketanalyse->competition = $request->competition;
            $businessplanmarketanalyse->opponent = $request->opponent;
            $businessplanmarketanalyse->save(); 
        }else{
            $businessplanmarketanalyse->update([
                'condition' => $request->condition,
                'share' => $request->share,
                'trend' => $request->trend,
                'tarket' => $request->tarket,
                'characteristicofcustomer' => $request->characteristicofcustomer,
                'competition' => $request->competition,
                'opponent' => $request->opponent
            ]);
        }

        $businessplanmarketopponent = BusinessPlanMarketOpponent::where('business_plan_id',$businessplan->id)->first();
        if(Empty($businessplanmarketopponent)){
            $businessplanmarketopponent = new BusinessPlanMarketOpponent();
            $businessplanmarketopponent->business_plan_id = $id;
            $businessplanmarketopponent->detail = $request->detail;
            $businessplanmarketopponent->opponentdetail = $request->opponentdetail;
            $businessplanmarketopponent->opponentname = $request->opponentname;
            $businessplanmarketopponent->service = $request->service;
            $businessplanmarketopponent->price = $request->price;
            $businessplanmarketopponent->distributionchannel = $request->distributionchannel;
            $businessplanmarketopponent->promotemarketing = $request->promotemarketing;
            $businessplanmarketopponent->save(); 
        }else{
            $businessplanmarketopponent->update([
                'detail' => $request->detail,
                'opponentdetail' => $request->opponentdetail,
                'opponentname' => $request->opponentname,
                'service' => $request->service,
                'price' => $request->price,
                'distributionchannel' => $request->distributionchannel,
                'promotemarketing' => $request->promotemarketing
            ]);
        }
        // return $businessplan;
        return redirect()->back();
    }
}


