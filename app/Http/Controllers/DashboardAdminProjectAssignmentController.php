<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ProjectAssignment;

class DashboardAdminProjectAssignmentController extends Controller
{
    public function Index(){
        $projectassignments = ProjectAssignment::get();
        // return $projectassignments;
        return view('dashboard.admin.projectassignment.index')->withProjectassignments($projectassignments);
    }
}
