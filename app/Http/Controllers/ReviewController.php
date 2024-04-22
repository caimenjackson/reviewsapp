<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Reviewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\Place;


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


    public function indexPlaces(Request $request)
{
    // Fetch places with the count of reviews, filtering to include only those with 4 or more reviews
    $places = Place::withCount('reviews')
                   ->having('reviews_count', '>=', 4) // Filter places with 4 or more reviews
                   ->orderBy('reviews_count', 'desc') // Optional: order by the number of reviews
                   ->paginate(20); // Paginate the results for display

    return view('reviews.places', compact('places'));
}


public function indexByJob(Request $request)
    {
        // Fetch all unique job titles for the dropdown
        $jobs = Reviewer::select('jobs')->distinct()->pluck('jobs');

        $selectedJob = $request->input('job');

        // Fetch reviews where reviewers have the selected job title
        if ($selectedJob) {
            $reviews = Review::whereHas('reviewer', function ($query) use ($selectedJob) {
                $query->where('jobs', $selectedJob); // Use 'jobs' instead of 'job'
            })->paginate(20);
        } else {
            $reviews = collect(); // Return an empty collection if no job is selected
        }

        return view('reviews.by_job', compact('reviews', 'jobs', 'selectedJob'));
    }

    public function placeStats()
    {
        $totalClosed = Place::where('closed', 1)->count();
        $totalOpen = Place::where('closed', 0)->count();

        return view('reviews.stats', compact('totalOpen', 'totalClosed'));
    }

    public function categoryAverages()
{
    // Calculate the average rating for each category and paginate the results
    $categoryAverages = Review::select('categories', DB::raw('AVG(rating) as average_rating'))
                              ->groupBy('categories')
                              ->orderBy('average_rating', 'desc')
                              ->paginate(20);  // Adjust the pagination size as needed

    return view('reviews.category_averages', compact('categoryAverages'));
}


public function topCategories()
{
    $topCategories = Review::select('categories', DB::raw('AVG(rating) as average_rating'))
                           ->groupBy('categories')
                           ->orderBy('average_rating', 'desc')
                           ->take(5)
                           ->get();

    return view('reviews.top_categories', compact('topCategories'));
}


public function mostReviewedPlace()
    {
        $mostReviewedPlace = Review::select('reviews.gPlusPlaceId', DB::raw('count(*) as review_count'), 'places.name')
                                   ->join('places', 'reviews.gPlusPlaceId', '=', 'places.gPlusPlaceId')
                                   ->groupBy('reviews.gPlusPlaceId', 'places.name')
                                   ->orderBy('review_count', 'desc')
                                   ->first();

        return view('reviews.most_reviewed_place', compact('mostReviewedPlace'));
    }

}
