<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Slider;

class adminHomeSliderController extends Controller
{

    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(Gate::allows('/admin/manage-home-slider')) return $next($request);

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
            $sliders = Slider::where('name', 'LIKE', "%$keyword%")
                        ->where('status', strtoupper($status))
                        ->paginate(10);
        } else {
            $sliders = Slider::where('name', 'LIKE', "%$keyword%")
                        ->paginate(10);

        }

        
        return view('admin.homeslider.index', ['sliders' => $sliders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.homeslider.create');
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
            "name"  => "required|unique:sliders",
            "image" => "required"
        ])->validate();

        $new_slider = new Slider;

        $name = $request->name;

        $new_slider->name = $name;
        $new_slider->slug = \Str::slug($name, '-');

        $image = $request->file('image');

        if ($image) {
            $image_path = $image->store('sliders', 'public');
            $new_slider->image = $image_path;
        }

        $new_slider->status = $request->save_action;
        $new_slider->save();

        if($request->save_action == 'PUBLISH'){
            return redirect()->route('manage-home-slider.create')->with('status', 'Image slider successfully tersimpan dan terpublish');
        } else {
            return redirect()->route('manage-home-slider.create')->with('status', 'Image slider tersimpan sebagai draft');
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
        $slider = Slider::findOrFail($id);

        return view('admin.homeslider.edit', ['slider' => $slider]);
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
        $slider = Slider::findOrFail($id);

        \Validator::make($request->all(), [
            "name" => "required",
            "status" => "required"
        ])->validate();

        $name = $request->name;

        $slider->name = $name;
        $slider->slug = \Str::slug($name, '-');

        $image = $request->file('image');

        if ($image) {
            if ($slider->image && file_exists(storage_path('app/public/'. $slider->image))) {
                \Storage::delete('public/'. $slider->image);
            }

            $new_image_path = $image->store('sliders', 'public');
            $slider->image = $new_image_path;
        }
        $slider->status = $request->status;
        $slider->save();

        return redirect()->route('manage-home-slider.edit', $slider->id)->with('status', 'Image slider berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        $slider->delete();

        return redirect()->route('manage-home-slider.index')->with('status','Image slider berhsil dipindahkan ke trash');
    }

    public function trash(Request $request)
    {
        $keyword = $request->keyword ? $request->keyword : '';

        $trash = Slider::where('name', 'LIKE', "%$keyword%")
                ->onlyTrashed()
                ->paginate(10);
        return view('admin.homeslider.trash', ['sliders' => $trash]);
    }

    public function restore($id)
    {
        $slider = Slider::withTrashed()->findOrFail($id);

        if($slider->trashed()) {
            $slider->restore();

            return redirect()->route('manage-home-slider.trash')->with('status', 'Image slider berhasil direstore');
        } else {
            return redirect()->route('manage-home-slider.trash')->with('status', 'Image slider tidak ada di trash')->with('status_type', 'alert');
        }

    }

    public function deletePermanent($id)
    {
        $slider = Slider::withTrashed()->findOrFail($id);

        if (!$slider->trashed()) {
            return redirect()->route('manage-home-slider.trash')->with('status', 'Image slider tidak ada di trash')->with('status_type', 'alert');
        } else {

             if ($slider->image && file_exists(storage_path('app/public/'. $slider->image))) {
                \Storage::delete('public/'. $slider->image);
            }
            
            $slider->forceDelete();

            return redirect()->route('manage-home-slider.trash')->with('status', 'Image slider berhasil dihapus permanen');
        }
    }
}
