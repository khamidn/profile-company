<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Service;

class adminServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(Gate::allows('/admin/manage-services')) return $next($request);

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
            $services = Service::where('title', 'LIKE', "%$keyword%")
                                ->where('status', strtoupper($status))
                                ->paginate(10);
        } else {
            $services = Service::where('title', 'LIKE', "%$keyword%")
                                ->paginate(10);
        }
        return view('admin.services.index', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');
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
            "subtitle" => "required",
            "image" => "required",
            "description" => "required"
        ])->validate();

        $title = $request->title;

        $newService = new Service;

        $newService->title = $title;
        $newService->subtitle = $request->subtitle;
        $newService->slug = \Str::slug($title, '-');

        $image = $request->file('image');

        if ($image) {
            $imagePath = $image->store('services', 'public');
            $newService->image = $imagePath;
        }

        $newService->description = $request->description;
        $newService->save();

        if ($request->save_action == 'PUBLISH') {
            return redirect()->route('manage-services.create')
                            ->with('status', 'Service baru berhasil ditambahkan dan dipublish');
        } else {
             return redirect()->route('manage-services.create')
                            ->with('status', 'Service baru berhasil ditambahkan sebagai draft');
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
        $service = Service::findOrFail($id);

        return view('admin.services.show', ['service' => $service]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', ['service' => $service]);
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
        $service = Service::findOrFail($id);

        \Validator::make($request->all(), [
            "title" => "required",
            "subtitle" => "required",
            "description" => "required",
            "status" => "required"
        ])->validate();

        $title = $request->title;

        $service->title = $title;
        $service->slug = \Str::slug($title, '-');
        $service->subtitle = $request->subtitle;

        $image = $request->file('image');

        if ($image) {
            if ($service->image && file_exists(storage_path('app/public/'. $service->image))) {
                \Storage::delete('public/'. $service->image);
            }

            $newImage = $image->store('sliders', 'public');
            $service->image = $newImage;
        }

         $service->description = $request->description;
         $service->status = $request->status;
         $service->save();

         return redirect()->route('manage-services.edit', $service->id)
                        ->with('status', 'Service berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        $service->delete();

        return redirect()->route('manage-services.index')->with('status', 'Service berhsil dipindahkan ke trash');
    }

    public function trash(Request $request)
    {
        $keyword = $request->keyword ? $request->keyword : '';

        $trash = Service::where('title', 'LIKE', "%$keyword%")
                        ->onlyTrashed()
                        ->paginate(10);
        return view('admin.services.trash', ['services' => $trash]);
    }

    public function restore($id)
    {
        $service = Service::withTrashed()->findOrFail($id);

        if ($service->trashed()) {
            $service->restore();

            return redirect()->route('manage-services.trash')
                            ->with('status', 'Service berhasil direstore');
        } else {

            return redirect()->route('manage-services.trash')
                            ->with('status', 'Service tidak ada di trash')
                            ->with('status_type', 'alert');
        }
    }

    public function deletePermanent($id)
    {
        $service = Service::withTrashed()->findOrFail($id);

        if (!$service->trashed()) {

            return redirect()->route('manage-services.trash')
                            ->with('status','Service tidak ada di trash')
                            ->with('status_type', 'alert');
        } else {

            if ($service->image && file_exists(storage_path('app/public/'. $service->image))) {
                \Storage::delete('public/'. $service->image);
            }

            $service->forceDelete();

            return redirect()->route('manage-services.trash')
                            ->with('status', 'Service berhsil dihapus permanen');
        }
    }

    
}
