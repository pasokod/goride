<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class VehicleTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        return view("vehicle_type.index");
    }


    public function edit($id)
    {
        return view('vehicle_type.edit')->with('id', $id);
    }

    public function create()
    {
        return view('vehicle_type.create');
    }


}
