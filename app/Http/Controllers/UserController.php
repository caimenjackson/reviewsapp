<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    
    public function create() {
        return view('users.register');
    }

     
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
            'address' => ['required', 'string', 'max:255'], 
            'date_of_birth' => ['required', 'date'], 
            'user_type' => ['required', Rule::in(['consumer', 'business'])],
            'business_name' => ['nullable', 'string', 'max:255'], 
        ]);

        
        $formFields['password'] = bcrypt($formFields['password']);

        
        $user = User::create($formFields);

        
        auth()->login($user);
        $request->session()->forget('warning_accepted');
        return redirect('/')->with('message', 'User created and logged in');

    }


    public function update(Request $request, User $user) {
        
        
    
        
        if($user->id != auth()->id()) {
            abort(403, 'Unauthorised Action');
        }
    
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)
            ],
            'address' => ['required', 'string', 'max:255'], 
            'date_of_birth' => ['required', 'date'], 
            'user_type' => ['required', Rule::in(['consumer', 'business'])],
            'business_name' => ['nullable', 'string', 'max:255'], 
        ]);

        $user->update($formFields);

        return redirect('/')->with('message', "User  {$user->name} updated successfully");

    }









    public function logout(Request $request) {
        auth()->logout();

        $request->session()->forget('login');
        $request->session()->forget('warning_accepted');
        

        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out');
    }


    
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



    
    public function destroy(User $user) {
        
        if($user->id != auth()->id()) {
            abort(403, 'Unauthorised Action');
        }

        $user->delete();
        return redirect('/')->with('message', 'You are now logged out. Account deleted successfully. ');
} 

    
    public function edit(User $user) {
        
        
        if($user->id != auth()->id()) {
            return redirect('/')->with('message', 'Unauthorised Action 403');
        }

        return view('users.update', ['user' => $user]);
    }





}
