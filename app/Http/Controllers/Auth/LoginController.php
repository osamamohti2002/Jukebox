<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLogInForm(){
        return view('auth.login');
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
            return redirect()->route('login')->with('wrong', 'Ongeldige wachtwoord');
        }
        Auth::login($user);
        $request->session()->regenerate();
        

        return redirect()->route('profile')->with('success', 'welkom terug ' . $user->name);
    }


}
