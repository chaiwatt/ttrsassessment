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
use App\ExcelFromView\Report\Project\ReportNumprojectExportSheet;
use App\ExcelFromView\Report\Project\ReportProjectExportByGradeSheet;
use App\ExcelFromView\Report\Project\ReportProjectObjectiveExportSheet;
use App\ExcelFromView\Report\Project\ReportProjectExportByIndustryGroupSheet;

class AdminReportController extends Controller
{
   public function NumProject(){
      return Excel::download(new ReportNumprojectExportSheet(), 'project.xlsx');
   }   
   public function ProjectGrade(){
      return Excel::download(new ReportProjectExportByGradeSheet(), 'projectgrade.xlsx');
   }  
   public function ProjectIndustry(){
      return Excel::download(new ReportProjectExportByIndustryGroupSheet(), 'projectindustrygroup.xlsx');
   }  
   public function ProjectObjective(){
      return Excel::download(new ReportProjectObjectiveExportSheet(), 'projectobjective.xlsx');
   }  
   // 
}
