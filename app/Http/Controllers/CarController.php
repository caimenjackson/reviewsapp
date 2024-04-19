<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CarController extends Controller
{
    //

    //view auth cars
    public function viewcars() {
        return view('cars.index', ['cars' => auth()->user()->cars()->get()]);
    }


    public function getUserCars() {
        return view('predictive.authenticated', ['userCars' => auth()->user()->cars()->get()]);
    }
    

    //view single car
    public function show(Car $car) {
        if($car->user_id != auth()->id()) {
            return redirect('/')->with('message', 'Unauthorised Action 403');
        }
        return view( 'cars.show', [
            'car' => $car
        ]);
    }

    //edit a car
    public function edit(Car $car) {
        // dd($listing->title);
        // dd($listing->description);
        if($car->user_id != auth()->id()) {
            return redirect('/')->with('message', 'Unauthorised Action 403');
        }

        return view('cars.edit', ['car' => $car]);
    }


    //Show add form
    public function add() {
        // dd($listing->title);
        // dd($listing->description);
        return view('cars.add');
    }

    public function store(Request $request) {
        // dd($request->all());
        $formFields = $request->validate([
            'registration' => 'required',
            'make' => 'required',
            'model' => 'required',
            'engine_size' => 'required',
            'mileage' => 'required',
        ]); 

        $formFields['user_id'] = auth()->id();
        $formFields['public']= "false";

        Car::create($formFields);

        return redirect('/cars')->with('message', "Car {$request->registration} added to your account");
    }


    public function update(Request $request, Car $car) {
        // dd($listing->description);
        // dd($request->file('logo')); allows to show the uploaded file data
    
        //Make sure logged in user is owner
        if($car->user_id != auth()->id()) {
            abort(403, 'Unauthorised Action');
        }
    
        $formFields = $request->validate([
            'registration' => 'required',
            'make' => 'required',
            'model' => 'required',
            'engine_size' => 'required',
            'mileage' => 'required',
        ]);

        $car->update($formFields);

        return back()->with('message', "Car {$car->registration} updated successfully");

    }


    //delete car
    public function destroy(Car $car) {
        //Make sure logged in user is owner
        if($car->user_id != auth()->id()) {
            abort(403, 'Unauthorised Action');
        }

        $car->delete();
        return redirect('/cars')->with('message', 'Car has been deleted from database.');
} 



    // public function store(Request $request) {
    //     dd($request);
    //     $formFields = $request->validate([
    //         'registration' => ['required', Rule::unique('cars', 'registration')],
    //         'make' => 'required',
    //         'model' => 'required',
    //         'engine_size' => 'required',
    //         'mileage' => 'required'

    //     ]);

    //     $formFields['user_id'] = auth()->id();

    //     Car::create($formFields);

    //     return redirect('/')->with('message', 'Car {{$car->registration}} added successfully');
    // }

    
}
