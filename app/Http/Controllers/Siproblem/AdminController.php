<?php

namespace App\Http\Controllers\Siproblem;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('siproblem.admin.main');
    }
}
