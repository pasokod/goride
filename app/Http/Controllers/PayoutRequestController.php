<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayoutRequestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id = '')
    {
        return view("payout_requests.index")->with('id',$id);
    }


}
