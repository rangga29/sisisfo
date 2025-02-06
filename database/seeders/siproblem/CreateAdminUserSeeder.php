<?php

namespace Database\Seeders\siproblem;

use App\Models\Siproblem\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CreateAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'dp_id' => 53,
            'nik' => 'administrator',
            'name' => 'Administrator',
            'password' => bcrypt('password'),
            'role' => 'Administrator',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
        ]);

//        $user = User::create([
//            'dp_id' => 14,
//            'nik' => '198407227',
//            'name' => 'IKA WAHYUNINGSIH, S.SI',
//            'password' => bcrypt('password'),
//            'role' => 'Kabag',
//            'remember_token' => Str::random(10),
//            'created_at' => now(),
//            'updated_at' => now()
//        ]);
//
//        $user = User::create([
//            'dp_id' => 14,
//            'nik' => '199423075',
//            'name' => 'SILVESTER RANGGA SURYA NUGROHO, S.KOM',
//            'password' => bcrypt('password'),
//            'role' => 'Staff',
//            'remember_token' => Str::random(10),
//            'created_at' => now(),
//            'updated_at' => now()
//        ]);
//
//        $user = User::create([
//            'dp_id' => 32,
//            'nik' => '196993013',
//            'name' => 'FX.RAHMAT KARSONO , AMD',
//            'password' => bcrypt('password'),
//            'role' => 'Kabag',
//            'remember_token' => Str::random(10),
//            'created_at' => now(),
//            'updated_at' => now()
//        ]);
//
//        $user = User::create([
//            'dp_id' => 32,
//            'nik' => '199212003',
//            'name' => 'CAMPUH PRAPTOMO, A.MD.T',
//            'password' => bcrypt('password'),
//            'role' => 'Staff',
//            'remember_token' => Str::random(10),
//            'created_at' => now(),
//            'updated_at' => now()
//        ]);
//
//        $user = User::create([
//            'dp_id' => 7,
//            'nik' => '199113140',
//            'name' => 'FRANSISCA WAHYU ANDANTI, A.MD.RMIK',
//            'password' => bcrypt('password'),
//            'role' => 'Kabag',
//            'remember_token' => Str::random(10),
//            'created_at' => now(),
//            'updated_at' => now()
//        ]);
//
//        $user = User::create([
//            'dp_id' => 7,
//            'nik' => '199215060',
//            'name' => 'FREDERIK KRISTIAN WIBISONO, A.MD.RMIK',
//            'password' => bcrypt('password'),
//            'role' => 'Staff',
//            'remember_token' => Str::random(10),
//            'created_at' => now(),
//            'updated_at' => now()
//        ]);
    }
}
