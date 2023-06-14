<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Generator;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create();
        Generator::factory(10)->create();
        Employee::factory(10)->create();
        Customer::factory(10)->create();
        Service::factory(500)->create();
    }
}
