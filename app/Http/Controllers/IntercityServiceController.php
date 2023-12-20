<?php

namespace App\Http\Controllers;

class IntercityServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        return view("intercity_service.index");
    }


    public function edit($id)
    {
        return view('intercity_service.edit')->with('id', $id);
    }

    public function create()
    {
        return view('intercity_service.create');
    }

    public function ridesList(){
        return view('intercity_service.ride-list');
    }

    public function rideView($id){
        return view('intercity_service.ride-view', compact('id'));
    }

}
