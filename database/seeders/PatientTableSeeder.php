<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientTableSeeder extends Seeder
{

    public function run()
    {
        $Patients = new Patient();
        $Patients->email = 'patient@yahoo.com';
        $Patients->password = Hash::make('12345678');
        $Patients->Date_Birth = '1988-12-01';
        $Patients->Phone = '+96650023003';
        $Patients->Gender = 1;
        $Patients->Blood_Group = 'O-';
        $Patients->save();

        //insert trans
        $Patients->name = 'محمد السيد';
        $Patients->Address = 'الرياض';
        $Patients->save();
    }
}
