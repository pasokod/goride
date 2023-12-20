<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reportGenerate($type)
    {
        if ($type == "user") {
            return view("reports.user-report");
        } elseif ($type == "driver") {
            return view("reports.driver-report");
        } elseif ($type == "ride") {
            return view("reports.ride-report");
        } elseif ($type == "intercity") {
            return view("reports.intercity-report");
        } elseif ($type == "transaction") {
            return view("reports.transaction-report");
        } else {
            return false;
        }
    }
}
