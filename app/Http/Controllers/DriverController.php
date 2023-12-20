<?php

namespace App\Http\Controllers;

class DriverController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
	  public function index()
    {
        return view("drivers.index");
    }

    public function edit($id)
    {
    	return view('drivers.edit')->with('id', $id);
    }

    public function view($id)
    {
        return view('drivers.view')->with('id', $id);
    }
    public function driverDocuments($id)
    {
        return view('drivers.documentIndex', compact('id'));
    }
    public function rulesIndex()
    {
        return view('drivers.rules.index');
    }
    public function deletedRulesIndex()
    {
        return view('drivers.rules.deletedIndex');
    }
    public function saveRule($id)
    {
        return view('drivers.rules.save', compact('id'));
    }
    public function driverDocumentUpload($driverId, $id)
    {
        return view('drivers.driverDocumentUpload', compact('driverId', 'id'));
    }
    
}


