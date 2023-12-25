<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{

    public function run()
    {
        $SingleService = new Service();
        $SingleService->price = 50;
        $SingleService->status = 1;
        $SingleService->save();
        // store trans
        $SingleService->name = 'مقابلة باطنية';
        $SingleService->save();
    }
}
