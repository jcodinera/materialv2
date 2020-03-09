<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateApprovals;
use Illuminate\Http\Request;

class ApprovalsController extends Controller
{
    public function create()
    {
        return view("approvals.create");
    }

    public function store(CreateApprovals $request)
    {

    }
}
