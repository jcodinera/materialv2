<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApprovalsController extends Controller
{
    public function create()
    {
        return view("approvals.create");
    }
}
