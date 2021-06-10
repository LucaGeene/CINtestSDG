<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectsController extends Controller
{

    public function index(Request $request)
    {


        $verify = $request->input('verify');
        $goalid = $request->input('goalid');
        $filter = array();
        $filter[0] = $verify;
        $filter[1] = $goalid;

        if ($filter[0] == null && $filter[1] == null) {
            return view('projects.index', [
                'projects' => Project::latest()->get(), 'filterarray' => $filter

            ]);
        } elseif ($filter[1] == null) {
            return view('projects.index', [
                'projects' => Project::latest()
                    ->where('verified', '=', $filter[0])
                    ->get(),
                'filterarray' => $filter

            ]);
        } elseif ($filter[0] == null) {
            return view('projects.index', [
                'projects' => Project::latest()
                    ->where('goalid', '=', $filter[1])
                    ->get(),
                'filterarray' => $filter

            ]);

        } else {
            return view('projects.index', [
                'projects' => Project::latest()
                    ->where('verified', '=', $filter[0])
                    ->where('goalid', '=', $filter[1])
                    ->get(),
                'filterarray' => $filter

            ]);
        }
    }

    public function show($id)
    {
        $project = Project::find($id);
        if($project->verified == true){
            return view('projects.show', ['project' => $project]);
        }

    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {

        request()->validate([
            'title' => 'required',
            'goalid' => 'required',
//            'excerpt' => 'required',
            'category' => 'required',
            'education' => 'required',
            'body' => 'required'
        ]);

        $project = new Project();
        $project->goalid = request('goalid');
        $project->title = request('title');
//        $project->excerpt = request('excerpt');
        $project->activity_type = request('activity_type');
        $project->category = request('category');
        $project->education = request('education');
        $project->body = request('body');

        $test = request('verified');
        if ($test  == "1234"){
            $project->verified = 1;
        }


        $project->save();

        return redirect('/projecten');
    }


}
