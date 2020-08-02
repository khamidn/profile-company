<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Sosmed;

class adminSosmedsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(Gate::allows('/admin/manage-sosmeds')) return $next($request);

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
        $keyword = $request->keyword ? $request->keyword : '';

        $sosmeds = Sosmed::where('sosmed_name', 'LIKE', "%$keyword%")
                            ->paginate(10);

        return view('admin.sosmeds.index', ['sosmeds' => $sosmeds]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sosmeds.create');
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
            "profileUrl" => "required"
        ])->validate();


        $newSosmed = new Sosmed;
        $newSosmed->sosmed_name = $request->name;
        $newSosmed->profile_url = $request->profileUrl;
        $newSosmed->save();

        return redirect()->route('manage-sosmeds.create')
                        ->with('status', 'Sosial Media berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sosmed = Sosmed::findOrFail($id);

        return view('admin.sosmeds.edit', ['sosmed' => $sosmed]);
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
        $sosmed = Sosmed::findOrFail($id);
        $sosmed->sosmed_name = $request->name;
        $sosmed->profile_url = $request->profileUrl;
        $sosmed->save();

        return redirect()->route('manage-sosmeds.edit', $sosmed->id)
                        ->with('status', 'Sosial media berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sosmed = Sosmed::findOrFail($id);

        $sosmed->delete();

        return redirect()->route('manage-sosmeds.index')
                        ->with('status', 'Image berhasil dipindahkan ke trash');
    }

    public function trash(Request $request)
    {
        $keyword = $request->keyword ? $request->keyword : '';

        $trash = Sosmed::where('sosmed_name', 'LIKE', "%$keyword%")
                            ->onlyTrashed()
                            ->paginate(10);

        return view('admin.sosmeds.trash', ['sosmeds' => $trash]);
    }

    public function restore($id)
    {
        $sosmed = Sosmed::withTrashed()->findOrFail($id);

        if ($sosmed->trashed()) {
            $sosmed->restore();

            return redirect()->route('manage-sosmeds.trash')
                            ->with('status', 'Sosial media berhasil direstore');
        } else {
            return redirect()->route('manage-sosmeds.trash')
                            ->with('status', 'Sosial media tida ada di trash')
                            ->with('statu_type', 'alert');
        }
    }

    public function deletePermanent($id)
    {
        $sosmed = Sosmed::withTrashed()->findOrFail($id);

        if (!$sosmed->trashed()) {
            return redirect()->route('manage-sosmeds.trash')
                            ->with('status', 'Sosial media tidak ada di trash')
                            ->with('status_type', 'alert');
        } else {
            $sosmed->forceDelete();

            return redirect()->route('manage-sosmeds.trash')
                            ->with('status', 'Sosial media berhasil dihapus permanen');
        }
    }
}
