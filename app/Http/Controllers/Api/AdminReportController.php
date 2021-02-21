<?php

namespace App\Http\Controllers\Api;
use Excel;
use App\Model\MiniTBP;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ExcelFromView\Report\Admin\ReportNumprojectExport;
use App\ExcelFromView\Report\Admin\ReportProjectGradeExport;
use App\ExcelFromView\Report\Admin\ReportProjectIndustryExport;
use App\ExcelFromView\Report\Admin\ReportProjectObjectiveExport;

class AdminReportController extends Controller
{
   public function NumProject(){
      return Excel::download(new ReportNumprojectExport(), 'project.xlsx');
   }   
   public function ProjectGrade(){
      return Excel::download(new ReportProjectGradeExport(), 'projectgrade.xlsx');
   }  
   public function ProjectIndustry(){
      return Excel::download(new ReportProjectIndustryExport(), 'projectindustrygroup.xlsx');
   }  
   public function ProjectObjective(){
      return Excel::download(new ReportProjectObjectiveExport(), 'projectobjective.xlsx');
   }  
   // 
}
