<?php

namespace Database\Seeders;

use App\Models\BodyType;
use Illuminate\Database\Seeder;

class BodyTypeSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Sedan', 'SUV', 'Hatchback', 'Coupe', 'Wagon'];

        foreach ($names as $name) {
            BodyType::firstOrCreate(['name' => $name]);
        }
    }
}