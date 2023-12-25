<?php

namespace Database\Seeders;

use App\Models\ParmacyEmployee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PharmacyEmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parmacy_employees = new ParmacyEmployee();
        $parmacy_employees->name = 'محمد حسن';
        $parmacy_employees->email = 'moh@gmail.com';
        $parmacy_employees->password = Hash::make('12345678');
        $parmacy_employees->save();
 
    }
}
