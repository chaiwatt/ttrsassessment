<?php

namespace App\Http\Controllers;

use App\Model\Criteria;
use App\Model\CriteriaGroup;
use App\Model\IndustryGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\CriteriaGroupTransaction;
use App\Http\Requests\CreateAssessmentCriteriaGroupRequest;

class SettingAdminAssessmentCriteriaGroupController extends Controller
{
    public function Index(){
        $criteriagroups = CriteriaGroup::get();
        return view('setting.admin.assessment.criteriagroup.index')->withCriteriagroups($criteriagroups);
    }
    public function Create(){
        $industrygroups = IndustryGroup::get();
        $criterias = Criteria::get();
        return view('setting.admin.assessment.criteriagroup.create')->withIndustrygroups($industrygroups)
                                                                ->withCriterias($criterias);
    }
    public function CreateSave(CreateAssessmentCriteriaGroupRequest $request){
        $criteriagroup = new CriteriaGroup();
        $criteriagroup->industry_group_id = $request->industrygroup;
        $criteriagroup->user_id = Auth::user()->id;
        $criteriagroup->name = $request->name;
        $criteriagroup->save();

        foreach($request->criterialist as $key => $criteria ){
            $criteriagrouptransaction = new CriteriaGroupTransaction();
            $criteriagrouptransaction->criteria_group_id = $criteriagroup->id;
            $criteriagrouptransaction->criteria_id = $criteria;
            $criteriagrouptransaction->save();
        }
        return redirect()->route('setting.admin.assessment.criteriagroup')->withSuccess('เพิ่มรายการเกณฑ์การประเมินสำเร็จ');
    }
    public function Edit($id){
        $criteriagrouptransactions = CriteriaGroupTransaction::where('criteria_group_id',CriteriaGroup::find($id)->id)->get();
        // return $criteriagrouptransactions;
        $industrygroups = IndustryGroup::get();
        $criteriagroup = CriteriaGroup::find($id);
        $criterias = Criteria::get();
        return view('setting.admin.assessment.criteriagroup.edit')->withIndustrygroups($industrygroups)
                                                                ->withCriterias($criterias)
                                                                ->withCriteriagrouptransactions($criteriagrouptransactions)
                                                                ->withCriteriagroup($criteriagroup);
    }
    public function EditSave(CreateAssessmentCriteriaGroupRequest $request, $id){
        $criteriagroup = CriteriaGroup::find($id)->update([
            'industry_group_id' => $request->industrygroup,
            'name' => $request->name,
            'user_id' => Auth::user()->id
        ]);

        $comming_array  = Array();
        $existing_array  = Array();
        $unique_array  = Array();
        foreach( $request->criterialist as $key => $criteria ){
            $comming_array[] = $criteria;
        }

        CriteriaGroupTransaction::where('criteria_group_id',$id)->whereNotIn('criteria_id',$comming_array)->delete();
        $existing_array = CriteriaGroupTransaction::where('criteria_group_id',$id)->pluck('criteria_id')->toArray();
        $unique_array = array_diff($comming_array, $existing_array);
        $criteriagroup = CriteriaGroup::find($id);
        foreach( $unique_array as $arr ){
            $criteriagrouptransaction = new CriteriaGroupTransaction();
            $criteriagrouptransaction->criteria_group_id = $criteriagroup->id;
            $criteriagrouptransaction->criteria_id = $arr;
            $criteriagrouptransaction->save();
        }
        foreach($request->criterialist as $key => $criteria ){
            $check = CriteriaGroupTransaction::where('criteria_group_id',$id)->first();
            if(Empty($check)){
                $criteriagrouptransaction = new CriteriaGroupTransaction();
                $criteriagrouptransaction->criteria_group_id = $criteriagroup->id;
                $criteriagrouptransaction->criteria_id = $criteria;
                $criteriagrouptransaction->save();
            }
        }
        return redirect()->route('setting.admin.assessment.criteriagroup')->withSuccess('แก้ไขรายการเกณฑ์การประเมินสำเร็จ');
    }
    public function Delete($id){
        CriteriaGroup::find($id)->delete();
        return redirect()->route('setting.admin.assessment.criteriagroup')->withSuccess('ลบรายการเกณฑ์การประเมินสำเร็จ');
    }
}
