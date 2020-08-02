<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Testimonial;

class adminTestimonialsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(Gate::allows('/admin/manage-testimonials')) return $next($request);

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
            $testimonials = Testimonial::where('name', 'LIKE', "%$keyword%")
                            ->where('status', strtoupper($status))
                            ->paginate(10);
        } else {
            $testimonials = Testimonial::where('name', 'LIKE', "%$keyword%")
                            ->paginate(10);
        }
        return view('admin.testimonials.index', ['testimonials' => $testimonials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonials.create');
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
            "name"              => "required",
            "image"             => "required",
            "asalKotaKbupaten"  => "required",
            "captions"          => "required",
        ])->validate();

        $newTestimoni = new Testimonial;

        $newTestimoni->name = $request->name;

        $image = $request->file('image');

        if ($image) {
            $imagePath = $image->store('testimonials', 'public');
            $newTestimoni->image = $imagePath;
        }

        $newTestimoni->asal_kota_kabupaten = $request->asalKotaKbupaten;
        $newTestimoni->captions = $request->captions;
        $newTestimoni->status = $request->save_action;
        $newTestimoni->save();

        if ($request->save_action == 'PUBLISH') {
            return redirect()->route('manage-testimonials.create')
                            ->with('status', 'Testimonial berhasil ditambahkan dan dipublish');
        } else {
            return redirect()->route('manage.testimonials.create')
                            ->with('status', 'Testimonial tersimpan sebagai draft');
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
        $testimonial = Testimonial::findOrFail($id);

        return view('admin.testimonials.show', ['testimonial' => $testimonial]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimoni = Testimonial::findOrFail($id);

        return view('admin.testimonials.edit', ['testimoni' => $testimoni]);
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
        $testimoni = Testimonial::findOrFail($id);

        \Validator::make($request->all(), [
            "name"              => "required",
            "asalKotaKbupaten"  => "required",
            "captions"          => "required",
            "status"            => "required",
        ])->validate();

        $testimoni->name = $request->name;
        $image = $request->file('image');

        if ($image) {
            if ($testimoni->image && file_exists(storage_path('app/public/'. $testimoni->image))) {
                \Storage::delete('public/'. $testimoni->image);
            }

            $newPath = $image->store('testimonials', 'public');
            $testimoni->image = $newPath;
        }

        $testimoni->captions = $request->captions;
        $testimoni->status = $request->status;
        $testimoni->save();

        return redirect()->route('manage-testimonials.edit', $testimoni->id)
                        ->with('status', 'Testimonial berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimoni = Testimonial::findOrFail($id);

        $testimoni->delete();

        return redirect()->route('manage-testimonials.index')
                        ->with('status', 'Testimoni berhasil dipindahkan ke trash');
    }

    public function trash(Request $request)
    {
        $keyword = $request->keyword ? $request->keyword : '';

        $trash = Testimonial::where('name', 'LIKE', "%$keyword%")
                            ->onlyTrashed()
                            ->paginate(10);
        return view('admin.testimonials.trash', ['testimonials' => $trash]);
    }

    public function restore($id)
    {
        $restore = Testimonial::withTrashed()->findOrFail($id);

        if ($restore->trashed()) {
            $restore->restore();

            return redirect()->route('manage-testimonials.trash')
                            ->with('status', 'Testmonial berhasil direstore');
        } else {
            return redirect()->route('manage-testimonials.trash')
                            ->with('status', 'Testimonial tidak ada di trash')
                            ->with('status_type', 'alert');
        }
    }

    public function deletePermanent($id)
    {
        $testimoni = Testimonial::withTrashed()->findOrFail($id);

        if (!$testimoni->trashed()) {
            return redirect()->route('manage-testimonials.trash')
                            ->with('status', 'Testimonial tidak ada di trash')
                            ->with('status', 'status_type', 'alert');
        } else {
            if ($testimoni->image && file_exists(storage_path('app/public/'. $testimoni->image))) {
                \Storage::delete('public/'. $testimoni->image);
            }

            $testimoni->forceDelete();

            return redirect()->route('manage-testimonials.trash')
                            ->with('status', 'Testimoni berhasil dihapus permanen');
        }
    }
}
