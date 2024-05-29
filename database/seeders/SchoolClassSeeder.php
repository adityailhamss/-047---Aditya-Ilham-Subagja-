<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 8; $i++) {
            foreach (range(1, 7) as $char) {
                $className = 'IPA '.$i.$char;

                SchoolClass::create([
                    'name' => $className,
                ]);
            }

            foreach (range(1, 7) as $char) {
                $className = 'IPS '.$i.$char;

                SchoolClass::create([
                    'name' => $className,
                ]);
            }
        }

        for ($i = 1; $i <= 4; $i++) {
            foreach (range(1, 3) as $char) {
                $className = 'Bahasa '.$i.$char;

                SchoolClass::create([
                    'name' => $className,
                ]);
            }
        }
    }
}
