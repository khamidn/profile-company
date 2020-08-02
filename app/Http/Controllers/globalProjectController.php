<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class globalProjectController extends Controller
{
    public function index(){

    	$projects = Project::where('status','PUBLISH')
    						->paginate(6);

    	return view('pivot.projects.index', ['projects' => $projects]);
    }

    public function slug(Project $projects)
    {
    	return view('pivot.projects.slug', ['project' => $projects]);
    }
}
