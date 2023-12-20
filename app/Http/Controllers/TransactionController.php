<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{

     public function __construct()
    {
       $this->middleware('auth');
    }


	  public function driverWalletTranscation()
    {

        return view("transaction.driver_transaction");
    }
    public function userWalletTransaction()
    {

        return view("transaction.user_transaction");
    }



}
