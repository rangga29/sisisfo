<?php

namespace App\Http\Controllers\Siproblem;

use App\Http\Controllers\Controller;
use App\Http\Requests\Siproblem\ProblemStoreRequest;
use App\Http\Requests\Siproblem\ProblemUpdateRequest;
use App\Models\Siproblem\Department;
use App\Models\Siproblem\Problem;
use Illuminate\Support\Str;

class ProblemController extends Controller
{
    public function index()
    {
        return view('siproblem.admin.problem.view', [
            'problems' => Problem::all()
        ]);
    }

    public function create()
    {
        return view('siproblem.admin.problem.create', [
            'departments' => Department::where('dp_spr', true)->get()
        ]);
    }

    public function store(ProblemStoreRequest $request)
    {
        $validateData = $request->validated();
        do {
            $validateData['pr_ucode'] = Str::random(20);
            $ucodeCheck = Problem::where('pr_ucode', $validateData['pr_ucode'])->exists();
        } while ($ucodeCheck);
        Problem::create($validateData);
        return redirect()->route('siproblem.admin.problem')->with('success', 'Data Problem Berhasil Ditambahkan');
    }

    public function edit(Problem $problem)
    {
        return view('siproblem.admin.problem.edit', [
            'problem' => Problem::where('pr_ucode', $problem->pr_ucode)->first(),
            'departments' => Department::where('dp_spr', true)->get()
        ]);
    }

    public function update(ProblemUpdateRequest $request, Problem $problem)
    {
        $validateData = $request->validated();
        $problem->update($validateData);
        return redirect()->route('siproblem.admin.problem')->with('success', 'Data Problem Berhasil Diubah');
    }

    public function destroy(Problem $problem)
    {
        $problem->delete();
        return redirect()->route('siproblem.admin.problem')->with('success', 'Data Problem Berhasil Dihapus');
    }
}
