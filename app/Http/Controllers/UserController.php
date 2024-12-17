<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->is_super_admin == 1) {
                $validated = $request->validate([
                    'first_name' => ['required', 'max:10'],
                    'last_name' => ['required', 'max:10'],
                    'display_name' => ['required', 'max:10'],
                    'email' => ['required', 'email', Rule::unique('users', 'email')],
                    'password' => ['required', 'min:6'],
                    'is_admin' => ['required']
                ]);
                User::create($validated);
                return redirect('/')->with('success' , "You successfully create the user!");
            }else if(Auth::user()->is_admin == 1){
                $validated = $request->validate([
                    'first_name' => ['required', 'max:10'],
                    'last_name' => ['required', 'max:10'],
                    'display_name' => ['required', 'max:10'],
                    'email' => ['required', 'email', Rule::unique('users', 'email')],
                    'password' => ['required', 'min:6'],
                    'is_admin' => ['sometimes']
                ]);
                User::create($validated);
                return redirect('/')->with('success' , "You successfully create the user!");
            }
        }else{
            $validated = $request->validate([
                'first_name' => ['required', 'max:10'],
                'last_name' => ['required', 'max:10'],
                'display_name' => ['required', 'max:10'],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => ['required', 'min:6'],
                'is_admin' => ['sometimes']
            ]);
            $user = User::create($validated);
            auth()->login($user);
            return redirect('/')->with('success' , "You successfully Sign Up!");
        }
    }

    public function login(request $request){
        $validated = $request->validate([
            'email' => ['required' , 'email'] ,
            'password' => ['required']
        ]);
        if(auth()->attempt($validated)){
            $request->session()->regenerate();
            return redirect('/')->with('success' , 'You are logged in successfully!');
        }else{
            return redirect('/')->with('failure' , 'Invalid data!');
        }
    }

    public function logout(Request $request){
        auth()->logout();
        return redirect('/')->with('success' , 'You successfully logged out!');
    }
}
