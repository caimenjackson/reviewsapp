<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;


// ######################## INDEX #############################

//show home page
Route::get('/', function () {
    return view('index');
});

// ######################## INDEX #############################

Route::get('/reviews/frequent', [ReviewController::class, 'frequent'])->name('reviews.frequent');

Route::post('/reviews/frequent', [ReviewController::class, 'showFrequentPhrases'])->name('frequent_words');

Route::get('/reviews/profiles', [ReviewController::class, 'showProfiles'])->name('reviews.profiles');

Route::get('/reviews/places', [ReviewController::class, 'showPlaces'])->name('reviews.places');




// List reviews
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');


// Show review details
Route::get('/reviews/{id}', [ReviewController::class, 'show'])->name('reviews.show');







// ######################## HTML PAGES #############################

//show terms and conditions page
Route::get('/termsandconditions', function () {
    return view('pages.tcs');
});


// ######################## END HTML #############################






// ######################## UAC #############################

//show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
//show signup form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
//create new user
Route::post('/users', [UserController::class, 'store']);
//Update User details
Route::put('/users/{user}', [UserController::class, 'update'])->middleware('auth');
//log user out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');


//Log in user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
//Show User Update Form
Route::get('/users/{user}/update', [UserController::class, 'edit'])->middleware('auth');
//Delete user account
Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('auth');
//show account home page
Route::get('/account', function () {
    $user = auth()->user(); // Fetch the authenticated user
    return view('users.home', compact('user')); // Pass the user data to the view
})->middleware('auth');

// ######################## END UAC #############################









// ######################## COOKIES #############################


// Route for accepting cookies
Route::post('/accept-cookies', function (Request $request) {
    // Set a cookie to remember that the user has accepted cookies
    $cookie = cookie('cookie_consent', true, 60 * 24 * 365); // Expires in 1 year
    return redirect()->back()->withCookie($cookie);
});

// Route for declining cookies
Route::get('/decline-cookies', function (Request $request) {
    // Remove the cookie
    return redirect()->back()->withCookie(cookie()->forget('cookie_consent'));
});

// ######################## END COOKIES #############################




// ########################  WARNING #############################



Route::middleware(['web'])->group(function () {
    Route::post('/accept-warning', function () {
        session(['warning_accepted' => true]);
        return redirect()->back();
    })->name('accept.warning');

    Route::get('/decline-warning', function () {
        session(['warning_accepted' => false]);
        return view('index');
    })->name('decline.warning');
});

// ######################## END COOKIES ###########################