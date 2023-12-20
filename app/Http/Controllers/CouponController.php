<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
    {
        return view("coupons.index");
    }

    public function save($id)
    {
    	return view('coupons.save', compact('id'));
    }

    public function deletedIndex()
    {
        return view("coupons.deleted-coupons-index");
    }
}
