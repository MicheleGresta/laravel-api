<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // INDEX HOME PAGE
    public function index(): View
    {
        $projects = Project::all();

        return view("admin.projects.index", compact("projects"));
    }

    // INDEX PROGETTI
    public function projectPage(): View
    {
        $projects = Project::all();

        return view("layouts.projectPage", compact("projects"));
    }

    // SHOW SINGLE PROJECTS
    //public function show(string $title)
    public function show($id)
    {
        // $projects = Project::where("title", $title)->first();
        $projects = Project::findOrFail($id);

        return view("admin.projects.show", compact("projects"));
    }

    public function showPublic($id)
    {
        $projects = Project::findOrFail($id);

        return view("projects.show", compact("projects"));
    }

    // CREATE NEW PROJECT
    public function create()
    {

        return view("admin.projects.create");
    }

    // STORE 
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
            'link' => 'required|string',
            'date' => 'nullable|date',
            'language' => 'nullable|string'
        ]);     
        $data["language"] = explode(", ", $data["language"]);


        // STORAGE PUT
        $img_path = Storage::put("uploads", $data["image"]);
         
        // $data->image = $img_path;
        $projects = Project::create($data);

        return redirect()->route("admin.projects.show", $projects->id);
    }

    // EDIT PROJECT
    public function edit($id)
    {
        $projects = Project::findOrFail($id);

        return view("admin.projects.edit", compact("projects"));
    }

    // UPDATE PROJECT
    public function update(Request $request, $id)
    {
        $projects = Project::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'link' => 'required|string',
            'date' => 'nullable|date',
            'language' => 'nullable|string'
        ]);

        $data["language"] = json_encode([$data["language"]]);
        // {{ join(', ', json_decode($projects->language))  nell' html

        $projects->update($data);

        return redirect()->route("admin.projects.show", $projects->id);
    }

    // DESTROY PROJECT
    public function destroy($id)
    {
        $projects = Project::findOrFail($id);
        $projects->delete();

        return redirect()->route("layouts.projectPage");
    }

}
