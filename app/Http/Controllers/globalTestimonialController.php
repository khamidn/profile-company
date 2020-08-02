<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonial;

class globalTestimonialController extends Controller
{
    public function index()
    {
    	$testimonials = Testimonial::where('status', 'PUBLISH')
    								->orderBy('created_at', 'DESC')
    								->paginate(6);

    	return view('pivot.testimonials.index', ['testimonials' => $testimonials]);
    }
}
