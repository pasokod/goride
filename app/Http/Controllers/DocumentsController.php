<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class DocumentsController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth');
    }


	public function index()
    {

        return view("documents.index");
    }
    public function deletedIndex()
    {
        return view("documents.deleted-document-index");
    }    
    public function save($id)
    {
        return view("documents.save", compact('id'));
    }

    public function edit($id)
    {
        return view('documents.edit')->with('id',$id);
    }

    public function create()
    {
        return view('documents.create');
    }


}
