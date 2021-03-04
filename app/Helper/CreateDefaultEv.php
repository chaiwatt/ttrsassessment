<?php
namespace App\Helper;

use App\Model\CheckListGrading;
use App\Model\PillaIndexWeigth;
use App\Model\CriteriaTransaction;

class CreateDefaultEv
{
    public static function createCriteriaTransaction($ev,$pillar,$subpillar,$subpillarindex,$criteria,$indextype){
        $criteriatransaction = new CriteriaTransaction();
        $criteriatransaction->ev_id = $ev;
        $criteriatransaction->pillar_id = $pillar;
        $criteriatransaction->ev_type_id = 1;
        $criteriatransaction->sub_pillar_id = $subpillar;
        $criteriatransaction->sub_pillar_index_id = $subpillarindex;
        $criteriatransaction->criteria_id = $criteria;
        $criteriatransaction->index_type_id = $indextype;
        $criteriatransaction->save();
    } 
    public static function createCheckListGrading($ev,$pillar,$subpillar,$subpillarindex){
        $checklistgrading = new CheckListGrading();
        $checklistgrading->ev_id = $ev;
        $checklistgrading->pillar_id = $pillar;
        $checklistgrading->sub_pillar_id = $subpillar;
        $checklistgrading->sub_pillar_index_id = $subpillarindex;
        $checklistgrading->save();
    } 
    public static function createPillaIndexWeigth($ev,$pillar,$subpillar,$subpillarindex){
        $pillaindexweigth = new PillaIndexWeigth();
        $pillaindexweigth->ev_id = $ev;
        $pillaindexweigth->pillar_id = $pillar;
        $pillaindexweigth->sub_pillar_id = $subpillar;
        $pillaindexweigth->sub_pillar_index_id = $subpillarindex;
        $pillaindexweigth->weigth = 0;
        $pillaindexweigth->save();
    } 
}
