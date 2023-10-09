<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // INDEX
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

    // SHOW
    //public function show(string $title)
    public function show($id)
    {
        // $projects = Project::where("title", $title)->first();
        $projects = Project::findOrFail($id);

        return view("admin.projects.show", compact("projects"));
    }

    // CREATE
    public function create()
    {

        return view("admin.projects.create");
    }

    // STORE
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
            'link' => 'required|string',
            'date' => 'nullable|date',
            'language' => 'nullable|string'
        ]);     
        $data["language"] = explode(", ", $data["language"]);
        
        $projects = Project::create($data);

        return redirect()->route("admin.projects.show", $projects->id);
    }

    // EDIT
    public function edit($id)
    {
        $projects = Project::findOrFail($id);

        return view("admin.projects.edit", compact("projects"));
    }

    // UPDATE
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

    // DESTROY
    public function destroy($id)
    {
        $projects = Project::findOrFail($id);
        $projects->delete();

        return redirect()->route("layouts.projectPage");
    }
}
