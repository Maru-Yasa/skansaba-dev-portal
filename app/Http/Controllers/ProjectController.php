<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('projects/list', $data=[
            'projects' => Project::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'link' => 'required'
        ]);

        // make project instance
        $newProject = Project::create($request->except(['_token', 'images']));

        // proccess image
        $images = $request->file('images');
        $moved_images = [];
        foreach ($images as $key => $image) {
            $filename = Carbon::now()->getPreciseTimestamp(3).".".explode('/',$image->getClientMimeType())[1];
            $image->move(base_path('public/images/project'), $filename);
            $moved_images[] = $filename;
            Image::create([
                'project_id' => $newProject->id,
                'alt' => 'image',
                'path' => $filename
            ]);
        }
        return redirect()->route('project.index')->with('success', 'Success create new project');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit', $data=[
            'data' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'link' => 'required'
        ]);

        $project->update($request->except(['_token', 'images']));

        if ($request->hasFile('images')) {

            // delete old images
            try {
                foreach ($project->images() as $key => $image) {
                    unlink(base_path('public/images/project').'/'.$image->path);
                }
            } catch (\Throwable $th) {

            }
            $project->images()->delete();

            // create new image
            $images = $request->file('images');
            $moved_images = [];
            foreach ($images as $key => $image) {
                $filename = Carbon::now()->getPreciseTimestamp(3).".".explode('/',$image->getClientMimeType())[1];
                $image->move(base_path('public/images/project'), $filename);
                $moved_images[] = $filename;
                Image::create([
                    'project_id' => $project->id,
                    'alt' => 'image',
                    'path' => $filename
                ]);
            }

        }

        return redirect()->route('project.index')->with('success', 'Success update project');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            foreach ($project->images as $key => $image) {
                unlink(base_path('public/images/project').'/'.$image->path);
            }
        } catch (\Throwable $th) {

        }
        $project->images()->delete();
        $project->delete();
        return redirect()->route('project.index')->with('success', 'Success deleting project');
    }
}
