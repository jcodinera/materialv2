<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequests;
use Illuminate\Http\Request;

class RequestsController extends Controller
{
    public function create()
    {
        return view("requests/create");
    }

    public function store(CreateRequests $requests)
    {

    }
}
