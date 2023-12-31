<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    
    public function index() 
    {
        // $projects = Project::all();
        $projects = Project::with("type", "technologies")->paginate();

        return response()->json($projects);

    }
    public function show($id) {

        $projects = Project::where("id", $id)
            ->with(["type", "technologies"])
            ->first();

        return response()->json($projects);
    }
}
