<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        return view("currency.index");
    }


    public function edit($id)
    {
        return view('currency.edit')->with('id', $id);
    }

    public function create()
    {
        return view('currency.create');
    }


}
