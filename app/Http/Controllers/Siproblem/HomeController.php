<?php

namespace App\Http\Controllers\Siproblem;

use App\Http\Controllers\Controller;
use App\Models\Siproblem\Spr;

class HomeController extends Controller
{
    public function index()
    {
        return view('siproblem.home', [
            'pribadi' => Spr::where('sender_id', auth()->user()->id)->orderBy('id', 'DESC')->get(),
            'bagian' => Spr::whereHas('sender', function ($query) {
                $query->where('dp_id', auth()->user()->dp_id);
            })->orderBy('id', 'DESC')->get()
        ]);
    }
}
