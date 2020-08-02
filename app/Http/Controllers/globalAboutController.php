<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;

class globalAboutController extends Controller
{
    public function index()
    {
    	$abouts = About::all();

    	return view('pivot.about.index', ['abouts' => $abouts]);
    }
}
