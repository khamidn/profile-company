<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Contact;

class adminContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(Gate::allows('/admin/manage-contact')) return $next($request);

            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index()
    {
    	$contact = Contact::first();

    	return view('admin.contact.index', ['contact' => $contact]);
    }

    public function update(Request $request, $id)
    {

    	$contact = Contact::findOrFail($id);

    	\Validator::make($request->all(), [
    		"alamat" => "required",
    		"kotaKabupaten" => "required",
    		"provinsi" => "required",
    		"kodePos" => "required",
    		"email1" => "required",
    		"phone" => "max:15",
    		"mobile" => "max:12",
    		"fax" => "max:12"
    	])->validate();

    	$contact->alamat = $request->alamat;
    	$contact->kota_kabupaten = $request->kotaKabupaten;
    	$contact->provinsi = $request->provinsi;
    	$contact->kode_pos = $request->kodePos;
    	$contact->email1 = $request->email1;
    	$contact->email2 = $request->email2;
    	$contact->phone = $request->phone;
    	$contact->mobile = $request->mobile;
    	$contact->fax = $request->fax;
    	$contact->save();

    	return redirect()->route('manage-contact.index')
    					->with('status', 'Update contact berhasil');


    }
}
