<?php

namespace Database\Seeders;

use App\Models\RayEmployee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RayEmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ray_employee = new RayEmployee();
        $ray_employee->name = 'ملاك سعد';
        $ray_employee->email = 'mlak@gmail.com';
        $ray_employee->password = Hash::make('12345678');
        $ray_employee->save();
    }
}
