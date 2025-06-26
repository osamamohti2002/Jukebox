<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;
use function PHPUnit\Framework\isReadable;

class UserController extends Controller
{
    


    public function showLogInForm(){
        return view('auth.login');
    }

    public function showRegistrationForm(){
        return view('auth.register');
    }


    public function profiel(){
        return view('user.profile'); // of een ander pad naar jouw profiel-view
    }


    function register(Request $request){

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            ]);


        $newUser = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        Auth::login($newUser); // correct als helper

        return redirect()->route('profiel');
    }


    public function login(Request $request){

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            ]);


        $user = User::where('email', $validated['email'])->first();
        if(!$user){
            return redirect()->route('login')->with('wrong', 'Ongeldige email');
        }

        if(!Hash::check($validated['password'], $user->password)){
            return redirect()->route('login')->with('wrong', 'Ongeldige email');
        }
        Auth::login($user);
        return redirect()->route('profile')->with('success', 'welkom terug ' . $user->name);
    }
}
