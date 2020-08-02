<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\About;


class adminAboutController extends Controller
{

    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(Gate::allows('/admin/manage-about')) return $next($request);

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
            $abouts = About::where('title', 'LIKE', "%$keyword%")
                            ->where('status', strtoupper($status))
                            ->paginate(10);
        } else {
            $abouts = About::where('title', 'LIKE', "%$keyword%")
                            ->paginate(10);
        }


        return view('admin.about.index', ['abouts' => $abouts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about.create');
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
            "title" => "required",
            "image" => "required", 
            "description" => "required"
        ])->validate();

        $newAbout = new About;

        $title = $request->title;

        $newAbout->title = $title;
        $newAbout->slug = \Str::slug($title, '-');

        $image = $request->file('image');

        if ($image) {
            $imagePath = $image->store('abouts', 'public');
            $newAbout->image = $imagePath;
        }

        $newAbout->status = $request->save_action;
        $newAbout->description = $request->description;
        $newAbout->save();

        if ($request->save_action == 'PUBLISH') {
            return redirect()->route('manage-about.create')
                            ->with('status', 'About berhasil tersimpan dan dipublish');
        } else {
            return redirect()->route('manage-about.create')
                            ->with('status', 'About disimpan sebagai draft');
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
        $about = About::findOrFail($id);

        return view('admin.about.show', ['about' => $about]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $about = About::findOrFail($id);

        return view('admin.about.edit', ['about' => $about]);
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
        $updateAbout = About::findOrFail($id);

        \Validator::make($request->all(), [
            "title" => "required",
            "description" => "required",
            "status" => "required"
        ])->validate();

        $title = $request->title;

        $updateAbout->title = $title;
        $updateAbout->slug = \Str::slug($title, '-');

        $image = $request->file('image');

        if ($image) {
            if ($updateAbout->image && file_exists('app/public/'. $updateAbout->image)) {
                \Storage::delete('public'. $updateAbout->image);
            }

            $newPath = $image->store('abouts', 'public');
            $updateAbout->image = $newPath;
        }

        $updateAbout->status = $request->status;
        $updateAbout->description = $request->description;
        $updateAbout->save();

        return redirect()->route('manage-about.edit', $updateAbout->id)
                        ->with('status', 'About berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about = About::findOrFail($id);

        $about->delete();

        return redirect()->route('manage-about.index')
                        ->with('status', 'About berhasil dipindahkan ke trash');
    }

    public function trash(Request $request)
    {
        $keyword = $request->keyword ? $request->keyword : '';

        $trash = About::where('title', 'LIKE', "%$keyword%")
                        ->onlyTrashed()
                        ->paginate(10);
        return view('admin.about.trash', ['abouts' => $trash]);

    }

    public function restore($id)
    {
        $about = About::withTrashed()->findOrFail($id);

        if ($about->trashed()) {
            $about->restore();

            return redirect()->route('manage-about.trash')
                            ->with('status', 'About berhasil direstore');
        } else {
            return redirect()->route('manage-about.trash')
                            ->with('status', 'About tidak ada di trash')
                            ->with('status_type', 'alert');
        }
    }

    public function deletePermanent($id)
    {
        $about = About::withTrashed()->findOrFail($id);

        if (!$about->trashed()) {
            return redirect()->route('manage-about.trash')->with('status', 'About tidak ada di trash')->with('status_type', 'alert');
        } else {

             if ($about->image && file_exists(storage_path('app/public/'. $about->image))) {
                \Storage::delete('public/'. $about->image);
            }
            
            $about->forceDelete();

            return redirect()->route('manage-about.trash')->with('status', 'About berhasil dihapus permanen');
        }
    }
}
