<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        $file = fopen(database_path('seeders/csv/reviews.csv'), 'r');
        fgetcsv($file); // Skip header

        while ($line = fgets($file)) {
            // Using regex to match the date pattern at the end of each line
            if (preg_match('/\s(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s\d{1,2},\s\d{4}$/', $line, $matches, PREG_OFFSET_CAPTURE)) {
                $datePosition = $matches[0][1];
                $reviewTime = trim(substr($line, $datePosition));
                $dataPart = substr($line, 0, $datePosition);
                
                // Splitting the rest of the data assuming tabs as the primary delimiter
                $data = explode("\t", $dataPart);
                
                if (count($data) >= 6) {
                    $gPlusPlaceId = $data[0];
                    $gPlusUserId = $data[1];
                    $rating = $data[2];
                    $reviewerName = $data[3];
                    $reviewText = $data[4];
                    $categories = $data[5];

                    $date = \DateTime::createFromFormat('M d, Y', $reviewTime);
                    $formattedDate = $date ? $date->format('Y-m-d H:i:s') : null;

                    // Check if place and user exist and insert if not
                    if (!DB::table('places')->where('gPlusPlaceId', $gPlusPlaceId)->exists()) {
                        DB::table('places')->insert([
                            'gPlusPlaceId' => $gPlusPlaceId,
                            'name' => 'Placeholder Place',
                            'closed' => false,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }

                    if (!DB::table('reviewers')->where('gPlusUserId', $gPlusUserId)->exists()) {
                        DB::table('reviewers')->insert([
                            'gPlusUserId' => $gPlusUserId,
                            'userName' => $reviewerName,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }

                    // Insert review
                    DB::table('reviews')->insert([
                        'gPlusPlaceId' => $gPlusPlaceId,
                        'gPlusUserId' => $gPlusUserId,
                        'rating' => $rating,
                        'reviewerName' => $reviewerName,
                        'reviewText' => $reviewText,
                        'categories' => $categories,
                        'reviewTime' => $formattedDate,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        fclose($file);
    }
}

