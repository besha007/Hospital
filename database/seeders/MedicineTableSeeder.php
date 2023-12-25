<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicines = new Medicine();
        $medicines->name = 'باندول';
        $medicines->group = 'مسكنات';
        $medicines->company = 'اميفارما';
        $medicines->cost = 10;
        $medicines->price = 13;
        $medicines->note = 'لا توجد';
        $medicines->exp = '2023-11-09';
        $medicines->save();
    }
}
