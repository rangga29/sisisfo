<?php

namespace App\Imports\Siproblem;

use App\Models\Siproblem\Department;
use App\Models\Siproblem\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection): void
    {
        foreach ($collection as $row) {
            $checkUser = User::where('nik', $row['nik'])->first();

            if($row['status'] == 'A') {
                if($row['jabatan'] == 'Kasie/Kabag/Koord') {
                    $role = 'Kabag';
                } else {
                    $role = 'Direktorat';
                }
            } else {
                $role = 'Staff';
            }

            if($checkUser) {
                $checkUser->update([
                    'name' => $row['nama'],
                    'password' => Hash::make($row['password']),
                    'dp_id' => Department::where('dp_code', $row['kdbagian'])->first()->id,
                    'role' => $role
                ]);
            } else {
                User::create([
                    'nik' => $row['nik'],
                    'name' => $row['nama'],
                    'password' => Hash::make($row['password']),
                    'dp_id' => Department::where('dp_code', $row['kdbagian'])->first()->id,
                    'role' => $role
                ]);
            }
        }
    }
}
