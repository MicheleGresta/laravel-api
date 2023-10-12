<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
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
        $types = Type::all();
        $technologies = Technology::all();

        return view("admin.projects.create", compact("types", "technologies"));
    }

    // STORE 
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|image|max:5120',
            'description' => 'nullable|string',
            'link' => 'required|string',
            'date' => 'nullable|date',
            'language' => 'nullable|string',
            'type_id' => 'exists:types,id',
            'technologies'=>'nullable'
        ]);

        // STORAGE PUT
        $data['image'] = Storage::put("uploads", $data["image"]);
        $projects = Project::create($data);

        // associazione 
        if (key_exists("technologies", $data)){
            $projects->technologies()->attach($data["technologies"]);
        }
        
        // if ($data["technologies"]){
        //     $projects->technologies()->attach($data["technologies"]);
        // }

        return redirect()->route("admin.projects.show", $projects->id);
    }

    // EDIT PROJECT
    public function edit($id)
    {
        $projects = Project::findOrFail($id);
        $types = Type::all();
        $technologies = Technology::all();
        

        return view("admin.projects.edit", compact("projects", "types", "technologies"));
    }

    // UPDATE PROJECT
    public function update(Request $request, $id)
    {
        $projects = Project::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|max:5120',
            'link' => 'required|string',
            'date' => 'nullable|date',
            'language' => 'nullable|string',
            'type_id' => 'exists:types,id',
            'technologies'=>'nullable'
        ]);


        // STORAGE PUT
        // $data["image"] = Storage::put("uploads", $data["image"]);
        // per riavere l'immagine vecchia
        if (isset($data["image"])){
            if ($projects->image){
                Storage::delete($projects->image);
            }
            $image_path = Storage::put("uploads", $data["image"]);
            $data["image"] = $image_path;
        };    

        // associazione
        $projects->technologies()->sync($data["technologies"]);

        // save 
        $projects->update($data);


        return redirect()->route("admin.projects.show", $projects->id);
    }

    // DESTROY PROJECT
    public function destroy($id)
    {
        $projects = Project::findOrFail($id);
        if ($projects->image) {
            Storage::delete($projects->image);
        }
        $projects->technologies()->detach();
        $projects->delete();

        return redirect()->route("layouts.projectPage");
    }
}
