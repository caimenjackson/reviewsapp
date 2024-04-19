<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CarController;
use App\Http\Controllers\PredictiveController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/test', function() {
//     return view('test');
// });

// Route::get('/index', function() {
//     return view('index');
// });

// ######################## INDEX #############################

//show home page
Route::get('/', function () {
    return view('index');
});

// ######################## INDEX #############################



// ######################## AI #############################

// Route::get('/predictive', function() {
//     $userCars = auth()->user()->cars()->get();
//     return view('predictive.index', ['userCars' => $userCars]);
// });

// Route::get('/predictive', [CarController::class, 'getUserCars']);

Route::get('/predictive', function () {
    return view('predictive.index');
});
// //view single car

// Route for authenticated users
// Route::middleware(['auth'])->get('/predictive', [CarController::class, 'getUserCars']);


// Route for unauthenticated users
// Route::middleware(['guest'])->get('/predictive', function () {
//     return view('predictive.unauthenticated');
// });



// ######################## END AI #############################



// ######################## CAR DETAILS #############################

//show Car Add Form
Route::get('/cars/add', [CarController::class, 'add'])->middleware('auth');
//Add new car POST Request
Route::post('/cars', [CarController::class, 'store']);
//Update Car details
Route::put('/cars/{car}', [CarController::class, 'update'])->middleware('auth');
//Show Car Update Form
Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->middleware('auth');
//Delete car from database
Route::delete('/cars/{car}/delete', [CarController::class, 'destroy'])->middleware('auth');
//View All Cars
Route::get('/cars', [CarController::class, 'viewCars'])->middleware('auth');
//view single car
Route::get('cars/{car}', [CarController::class, 'show']);

// ######################## END CARS #############################



// ######################## HTML PAGES #############################

//show terms and conditions page
Route::get('/termsandconditions', function () {
    return view('pages.tcs');
});

Route::post('/predictive', [PredictiveController::class, 'analyse']);

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




// ######################## ARTIFICIAL WARNING #############################


// Route::post('/accept-warning', function () {
//     Session::put('ai_warning_accepted', true);
//     return redirect()->back();
// });

// Route::get('/decline-warning', function () {
//     Session::forget('ai_warning_accepted');
//     return redirect()->back();
// });


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



Route::middleware(['auth'])->get('/user-cars', [CarController::class, 'getUserCars'])->name('user.cars');



//cookie programming
// Route::post('/accept-cookies', function (Request $request) {
//     // Store a session variable to indicate cookie consent
//     session(['cookie_consent' => true]);
//     // Debug: Inspect session data
//     // dd(session('cookie_consent'));
//     return redirect()->back();
// });
// // Optionally handle cookie removal
// Route::get('/decline-cookies', function (Request $request) {
//     // Optionally, remove any existing cookies
//     session()->forget('cookie_consent');

//     return redirect()->back();
// });

// ######################## END COOKIES ###########################