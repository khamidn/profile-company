<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;

class globalServiceController extends Controller
{
    public function index() 
    {
    	$services = Service::where('status', 'PUBLISH')->paginate(6);

    	return view('pivot.services.index', ['services' => $services]);
    }

    public function slug(Service $services)
    {
    	return view('pivot.services.slug', ['service' => $services]);
    }
}
