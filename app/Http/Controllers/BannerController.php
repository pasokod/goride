<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
    {
        return view("banners.index");
    }

    public function save($id)
    {
    	return view('banners.save', compact('id'));
    }

    public function deletedIndex()
    {
        return view("banners.deleted-banners-index");
    }
}
