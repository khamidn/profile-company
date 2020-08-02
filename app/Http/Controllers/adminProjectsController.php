<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Gate;
use App\Project;

class adminProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(Gate::allows('/admin/manage-projects')) return $next($request);

            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->status;
        $keyword = $request->keyword ? $request->keyword : '';

        if ($status) {
            $projects = Project::where('name', 'LIKE', "%$keyword%")
                        ->where('status', strtoupper($status))
                        ->paginate(10);
        } else {
            $projects = Project::where('name', 'LIKE', "%$keyword%")
                        ->paginate(10);
        }

        return view('admin.projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            "name" => "required",
            "image" => "required",
            "description" => "required"
        ])->validate();
        
        $newProject = new Project;
        
        $name = $request->name;
        
        $newProject->name = $name;
        $newProject->slug = \Str::slug($name, '-');

        $image = $request->file('image');

        if ($image) {
            $imagePath = $image->store('projects', 'public');
            $newProject->image = $imagePath;
        }

        $newProject->description = $request->description;
        $newProject->status = $request->save_action;
        $newProject->save();

        if ($request->save_action == 'PUBLISH') {
            return redirect()->route('manage-projects.create')
                            ->with('status', 'Project berhasil tersimpan dan dipublish');
        } else {
            return redirect()->route('manage-projects.create')
                            ->with('status', 'Project tersimpan sebagai draft');
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('admin.projects.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('admin.projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        \Validator::make($request->all(), [
            "name" => "required",
            "description" => "required",
            "status" => "required"
        ])->validate();

        $name = $request->name;

        $project->name = $name;
        $project->slug = \Str::slug($name, '-');

        $image = $request->file('image');

        if ($image) {
            if ($project->image && file_exists('app/public/'. $project->image)) {
                \Storage::delete('public/'. $project->image);
            }

            $newPath = $image->store('projects', 'public');
            $project->image = $newPath;
        }

        $project->description = $request->description;
        $project->status = $request->status;
        $project->save();

        return redirect()->route('manage-projects.edit', $project->id)
                        ->with('status', 'Project berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();

        return redirect()->route('manage-projects.index')
                        ->with('status', 'Project berhasil dipindahkan ke trash');
    }

    public function trash(Request $request)
    {

        $keyword = $request->keyword ? $request->keyword : '';

        $trash = Project::where('name', 'LIKE', "%$keyword%")
                    ->onlyTrashed()
                    ->paginate(10);
        return view('admin.projects.trash', ['projects' => $trash]);
    }

    public function restore($id)
    {
        $project = Project::withTrashed()->findOrFail($id);

        if ($project->trashed()) {
            $project->restore();

            return redirect()->route('manage-projects.trash')
                            ->with('status', 'Project berhasil direstore');
        } else {
            return redirect()->route('manage-projects.trash')
                            ->with('status', 'Project tidak ada di trash')
                            ->with('status_type', 'alert');
        }
    }

    public function deletePermanent($id)
    {
        $project = Project::withTrashed()->findOrFail($id);

        if ($project->trashed()) {
            if ($project->image && file_exists(storage_path('app/public/'. $project->image))) {
                \Storage::delete('public/'. $project->image);
            }

            $project->forceDelete();

            return redirect()->route('manage-projects.trash')
                            ->with('status', 'Project berhasil dihapus permanen');
        } else {
            return redirect()->route('manage-projects.trash')
                            ->with('Project tidak ada di trash')
                            ->with('status_type', 'alert');
        }
    }
}
