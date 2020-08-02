<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Project;
use App\Service;
use App\Testimonial;

class globalHomeController extends Controller
{
    public function index()
    {
    	$sliders = Slider::where('status','PUBLISH')->get();

    	$projects = Project::orderBy('id','DESC')
                            ->where('status', 'PUBLISH')
                            ->limit(6)
                            ->get();

    	$services = Service::orderBy('id', 'DESC')
                            ->where('status', 'PUBLISH')
                            ->limit(3)
                            ->get();

    	$testimonials = Testimonial::orderBy('id', 'DESC')
                                    ->where('status', 'PUBLISH')
                                    ->limit(2)
                                    ->get();

    	return view('pivot.home.index', [
    										'sliders' => $sliders,
    										'projects' => $projects,
    										'services' => $services,
    										'testimonials' => $testimonials,
    				]);
    }
}
