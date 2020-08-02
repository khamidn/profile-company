<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class globalContactController extends Controller
{
    public function index()
    {
    	$contact = Contact::first();

    	return view('pivot.contact.index', ['contact' => $contact]);
    }
}
