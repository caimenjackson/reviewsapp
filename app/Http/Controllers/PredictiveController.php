<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class PredictiveController extends Controller
{
    public function index()
    {
        $userVehicles = [];
    }

//     public function analyse(Request $request)
// {

//     dd($request->all());
//     // Check if the user is authenticated
//     if (auth()->check()) {
//         // Check if the user selected a car from their garage
//         if ($request->filled('user_car_id')) {
//             // User selected a car from their garage
//             $selectedCarId = $request->input('user_car_id');
//             // Retrieve the selected car details from the database
//             $selectedCar = auth()->user()->cars()->findOrFail($selectedCarId);
//             // Perform further actions with the selected car
//             return view('index');
//         } else {
//             // User manually entered a different car's details
//             $make = $request->input('make');
//             $model = $request->input('model');
//             $year = $request->input('year');
//             // Perform further actions with the manually entered car details
//         }
//     } else {
//         // User is not authenticated, handle the case for non-authenticated users
//     }
// }



public function analyse(Request $request) {
    $carId = $request->input('car');
    $make = $request->input('make');
    $model = $request->input('model');
    $year = $request->input('year');

    if (!empty($carId)) {
        // Handle the case where a car is selected
        // Retrieve the car details based on the car ID
        $car = Car::find($carId);
        dd($request->all());
        // Process the selected car
    } elseif (!empty($make) && !empty($model) && !empty($year)) {
        dd($request->all());
        // Handle the case where make, model, and year are manually entered
        // Process the manually entered make, model, and year
    } else {
        // Handle the case where neither a car nor make, model, and year are provided
        // Display an error message or redirect back with an error
    }
}




}
