<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ip' => 'required',
            'project_id' => 'required'
        ]);

        if (!$validator->fails()) {
            $checkUnique = Visitor::all()->where('project_id', $request->project_id)->where('ip', $request->ip)->count();
            if ($checkUnique == 0) {
                $project = Project::all()->where('id', $request->project_id)->first();
                $project->update([
                    'visitor' => $project->visitor +1
                ]);
                Visitor::create($request->all());
            }
        }else{
            return response()->json($validator->errors());
        }

        return response()->json($checkUnique);

    }

    /**
     * Display the specified resource.
     */
    public function show(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visitor $visitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visitor $visitor)
    {
        //
    }
}
