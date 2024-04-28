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
    
    $rating = $request->input('rating'); 
    $price = $request->input('price'); 

    
    $query = Review::join('places', 'reviews.gPlusPlaceId', '=', 'places.gPlusPlaceId')
                   ->select('reviews.*', 'places.name as place_name', 'places.price as price');

    
    if ($rating) {
        $query->where('reviews.rating', $rating);
    }

    
    if ($price) {
        $query->where('places.price', $price);
    }

    
    $reviews = $query->paginate(20);

    
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
            $words = explode(' ', $review->reviewText); 
            for ($i = 0; $i < count($words) - 2; $i++) { 
                $phrase = $words[$i] . ' ' . $words[$i + 1] . ' ' . $words[$i + 2];
                if (!isset($phrases[$phrase])) {
                    $phrases[$phrase] = 0;
                }
                $phrases[$phrase]++;
            }
        }

        arsort($phrases); 
        return array_slice($phrases, 0, 20); 
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
        return view('reviews.frequent');
    }


    public function showProfiles(Request $request)
    {
        
        $selectedJob = $request->input('jobs', '');

        
        $jobs = Reviewer::select('jobs')
                    ->distinct()
                    ->orderBy('jobs', 'asc')  
                    ->pluck('jobs')
                    ->filter()
                    ->all();

        
        
        $reviewers = $selectedJob ? Reviewer::where('jobs', $selectedJob)->paginate(20) : Reviewer::paginate(20);


        
        return view('reviews.profiles', compact('jobs', 'reviewers', 'selectedJob'));
    }


    public function showPlaces()
    {
        return view('reviews.places');
    }


    public function indexPlaces(Request $request)
{
    
    $places = Place::withCount('reviews')
                   ->having('reviews_count', '>=', 4) 
                   ->orderBy('reviews_count', 'desc') 
                   ->paginate(20); 

    return view('reviews.places', compact('places'));
}


public function indexByJob(Request $request)
    {
        
        $jobs = Reviewer::select('jobs')->distinct()->pluck('jobs');

        $selectedJob = $request->input('job');

        
        if ($selectedJob) {
            $reviews = Review::whereHas('reviewer', function ($query) use ($selectedJob) {
                $query->where('jobs', $selectedJob); 
            })->paginate(20);
        } else {
            $reviews = collect(); 
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
    
    $categoryAverages = Review::select('categories', DB::raw('AVG(rating) as average_rating'))
                              ->groupBy('categories')
                              ->orderBy('average_rating', 'desc')
                              ->paginate(20);  

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
