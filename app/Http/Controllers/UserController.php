<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    //Display the register form
    public function create() {
        return view('users.register');
    }

     //store new users
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
            'address' => ['required', 'string', 'max:255'], // address is not nullable
            'date_of_birth' => ['required', 'date'], // date_of_birth is not nullable
            'user_type' => ['required', Rule::in(['consumer', 'business'])],
            'business_name' => ['nullable', 'string', 'max:255'], // business_name is nullable
        ]);

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        //create user
        $user = User::create($formFields);

        //login
        auth()->login($user);
        $request->session()->forget('warning_accepted');
        return redirect('/')->with('message', 'User created and logged in');

    }


    public function update(Request $request, User $user) {
        // dd($listing->description);
        // dd($request->file('logo')); allows to show the uploaded file data
    
        //Make sure logged in user is owner
        if($user->id != auth()->id()) {
            abort(403, 'Unauthorised Action');
        }
    
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)
            ],
            'address' => ['required', 'string', 'max:255'], // address is not nullable
            'date_of_birth' => ['required', 'date'], // date_of_birth is not nullable
            'user_type' => ['required', Rule::in(['consumer', 'business'])],
            'business_name' => ['nullable', 'string', 'max:255'], // business_name is nullable
        ]);

        $user->update($formFields);

        return redirect('/')->with('message', "User  {$user->name} updated successfully");

    }









    public function logout(Request $request) {
        auth()->logout();

        $request->session()->forget('login');
        $request->session()->forget('warning_accepted');
        // $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out');
    }


    //show login form
    public function login() {
        return view('users.login');
    }

    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();
            
            $request->session()->forget('warning_accepted');

            return redirect('/')->with('message', 'Logged In Successfully');
        }
        return back()->withErrors(['email' => 'Invalid Login'])->onlyInput('email');

    }



    //Delete User Account
    public function destroy(User $user) {
        //Make sure logged in user is owner
        if($user->id != auth()->id()) {
            abort(403, 'Unauthorised Action');
        }

        $user->delete();
        return redirect('/')->with('message', 'You are now logged out. Account deleted successfully. ');
} 

    //edit a user
    public function edit(User $user) {
        // dd($listing->title);
        // dd($listing->description);
        if($user->id != auth()->id()) {
            return redirect('/')->with('message', 'Unauthorised Action 403');
        }

        return view('users.update', ['user' => $user]);
    }





}
