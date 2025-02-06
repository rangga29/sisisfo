<?php

namespace App\Http\Controllers\Siproblem;

use App\Http\Controllers\Controller;
use App\Imports\Siproblem\UsersImport;
use App\Models\Siproblem\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        return view('siproblem.admin.users.view', [
            'users' => User::all()
        ]);
    }

    public function import()
    {
        return view('siproblem.admin.users.import');
    }

    public function update(Request $request)
    {
        Excel::import(new UsersImport, $request['data_user']);
        return redirect()->route('siproblem.admin.user')->with('success', 'Data User Berhasil Diimport');
    }
}
