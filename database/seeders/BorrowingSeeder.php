<?php

namespace Database\Seeders;

use App\Models\Borrowing;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon; // Tambahkan ini

class BorrowingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $borrowings = Borrowing::factory(5)->make()->toArray();

        $recordsToInsert = [];
        foreach ($borrowings as $borrowing) {
            $createdAt = Carbon::create(2024, rand(1, 12), rand(1, 28));
            $borrowing['created_at'] = $createdAt;
            $borrowing['updated_at'] = $createdAt;
            $recordsToInsert[] = $borrowing;
        }

        foreach (array_chunk($recordsToInsert, count($recordsToInsert) / 2) as $chunk) {
            Borrowing::insert($chunk);
        }
    }
}
