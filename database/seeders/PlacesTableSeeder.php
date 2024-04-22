<?php

namespace Database\Seeders;

// PlacesTableSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlacesTableSeeder extends Seeder
{
    public function run()
    {
        $file = fopen(database_path('seeders/csv/places.csv'), 'r');

        fgetcsv($file); // Skip header

        while ($row = fgetcsv($file, 1000, "\t")) {
            DB::table('places')->insert([
                'gPlusPlaceId' => $row[0],
                'name' => $row[1],
                'price' => $row[2] ?: null,
                'address' => $row[3] ?: null,
                'hours' => $row[4] ?: null,
                'phone' => $row[5] ?: null,
                'closed' => strtolower($row[6]) === 'true' ? 1 : 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        fclose($file);
    }
}

