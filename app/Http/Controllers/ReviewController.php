<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Reviewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    public function index(Request $request)
{
    // Retrieve rating and price from the request
    $rating = $request->input('rating'); // Get the rating filter from the request
    $price = $request->input('price'); // Get the price filter from the request

    // Construct the query with a join and basic select
    $query = Review::join('places', 'reviews.gPlusPlaceId', '=', 'places.gPlusPlaceId')
                   ->select('reviews.*', 'places.name as place_name', 'places.price as price');

    // Apply the rating filter if present
    if ($rating) {
        $query->where('reviews.rating', $rating);
    }

    // Apply the price filter if present
    if ($price) {
        $query->where('places.price', $price);
    }

    // Execute the query with pagination
    $reviews = $query->paginate(20);

    // Return the view with reviews and current filter settings
    return view('reviews.index', compact('reviews', 'rating', 'price'));
}






    public function getReviewsByRating($rating)
    {
        return Review::where('rating', $rating)->get();
    }


    public function extractFrequentPhrases($reviews)
    {
        $phrases = [];
        foreach ($reviews as $review) {
            $words = explode(' ', $review->reviewText); // Split the review into words
            for ($i = 0; $i < count($words) - 2; $i++) { // Ensure there's enough room for a 3-word sequence
                $phrase = $words[$i] . ' ' . $words[$i + 1] . ' ' . $words[$i + 2];
                if (!isset($phrases[$phrase])) {
                    $phrases[$phrase] = 0;
                }
                $phrases[$phrase]++;
            }
        }

        arsort($phrases); // Sort phrases by frequency in descending order
        return array_slice($phrases, 0, 20); // Return the top 20 phrases
    }


    public function showFrequentPhrases(Request $request)
    {
        $rating = $request->input('rating');
        $reviews = $this->getReviewsByRating($rating);
        $frequentPhrases = $this->extractFrequentPhrases($reviews);

            return view('reviews.frequent', compact('frequentPhrases'));
    }


    public function show($id)
    {
        $review = Review::findOrFail($id);
        return view('reviews.show', compact('review'));
    }

    public function frequent()
    {
        // Your code to handle the 'frequent review phrases' functionality
        return view('reviews.frequent');
    }


    public function showProfiles(Request $request)
    {
        // Fetch the current job selection from the request, default to empty if none provided
        $selectedJob = $request->input('jobs', '');

        // Fetch all unique job titles from the reviewers table to populate the dropdown
        $jobs = Reviewer::select('jobs')
                    ->distinct()
                    ->orderBy('jobs', 'asc')  // Sorting alphabetically
                    ->pluck('jobs')
                    ->filter()
                    ->all();

        // Conditionally fetch reviewers based on the selected job, or all if none selected
        // Fetch reviewers as a collection
        $reviewers = $selectedJob ? Reviewer::where('jobs', $selectedJob)->paginate(20) : Reviewer::paginate(20);


        // Always return the 'jobs', 'reviewers', and 'selectedJob' to the view
        return view('reviews.profiles', compact('jobs', 'reviewers', 'selectedJob'));
    }


    public function showPlaces()
    {
        // Your code to handle the 'frequent review phrases' functionality
        return view('reviews.places');
    }


}
