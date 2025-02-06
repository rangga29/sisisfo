<?php

namespace Database\Seeders;

use Database\Seeders\siproblem\CreateAdminUserSeeder;
use Database\Seeders\siproblem\DepartmentSeeder;
use Database\Seeders\siproblem\ProblemSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            CreateAdminUserSeeder::class,
            ProblemSeeder::class
        ]);
    }
}
