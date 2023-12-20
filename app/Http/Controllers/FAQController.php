<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
    {
        return view("faqs.index");
    }

    public function save($id=null)
    {
    	return view('faqs.save', compact('id'));
    }

    public function deleted()
    {
        return view("faq.deleted");
    }
}
