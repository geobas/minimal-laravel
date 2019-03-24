<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Helpers\Weather;

class ContentsController extends Controller
{
	//
    public function home(Request $request, Weather $weather)
    {
    	$data = [];
    	$data['last_updated'] = $request->session()->has('last_updated') ? $request->session()->pull('last_updated') : 'none';

        $data['weather'] = $weather->show();

    	return view('content/home', $data);
    }

    public function upload(Request $request)
    {
    	$data = [];

    	if( $request->isMethod('post') )
    	{
    		$this->validate(
    			$request,
    			[
    				'image_upload' => 'mimes:jpeg,bmp,png'
    			]
    		);
    		Input::file('image_upload')->move('images','attractions.jpg');
    		return redirect('/');
    	}

    	return view('content/upload', $data);
    }

}
