<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AirportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
    {
        return view("airports.index");
    }

    public function save($id='')
    {
    	return view('airports.save')->with('id', $id);
    }

   
}
