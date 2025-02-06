<?php

namespace App\Http\Controllers\Siproblem;

use App\Http\Controllers\Controller;
use App\Http\Requests\Siproblem\DepartmentStoreRequest;
use App\Http\Requests\Siproblem\DepartmentUpdateRequest;
use App\Models\Siproblem\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('siproblem.admin.department.view', [
            'departments' => Department::all()
        ]);
    }

    public function create()
    {
        return view('siproblem.admin.department.create');
    }

    public function store(DepartmentStoreRequest $request)
    {
        $validateData = $request->validated();
        $validateData['dp_group'] = $validateData['dp_group'] == 'TIDAK ADA' ? '' : $validateData['dp_group'];
        Department::create($validateData);
        return redirect()->route('siproblem.admin.department')->with('success', 'Data Department Berhasil Ditambahkan');
    }

    public function edit(Department $department)
    {
        return view('siproblem.admin.department.edit', [
            'department' => Department::where('id', $department->id)->first()
        ]);
    }

    public function update(DepartmentUpdateRequest $request, Department $department)
    {
        $validateData = $request->validated();
        $validateData['dp_group'] = $validateData['dp_group'] == 'TIDAK ADA' ? '' : $validateData['dp_group'];
        $department->update($validateData);
        return redirect()->route('siproblem.admin.department')->with('success', 'Data Department Berhasil Diubah');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('siproblem.admin.department')->with('success', 'Data Department Berhasil Dihapus');
    }
}
