<?php

namespace Database\Seeders;

// ReviewersTableSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewersTableSeeder extends Seeder
{
    public function run()
    {
        $file = fopen(database_path('seeders/csv/reviewers.csv'), 'r');

        // Skip the header row
        fgetcsv($file);

        while ($row = fgetcsv($file, 1000, "\t")) {
            DB::table('reviewers')->insert([
                'gPlusUserId' => $row[0],
                'userName' => $row[1],
                'jobs' => $row[2] ?: null,
                'currentPlace' => $row[3] ?: null,
                'previousPlace' => $row[4] ?: null,
                'education' => $row[5] ?: null,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        fclose($file);
    }
}
