<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Doctor::factory()->count('10')->create();
        // $Appointments = Appointment::all();
        // Doctor::all()->each(function ($doctor) use ($Appointments) {
        //     $doctor->doctorappointments()->attach(
        //         $Appointments->random(rand(1, 7))->pluck('id')->toArray()
        //     );
        // });
    }
}
