<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentsController extends Controller
{
	//
    public function home(Request $request)
    {
    	$data = [];
    	$data['last_updated'] = $request->session()->has('last_updated') ? $request->session()->pull('last_updated') : 'none';

    	return view('content/home', $data);
    }
}
