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
    public function profile(){
        return view('user.profile'); // of een ander pad naar jouw profiel-view
    }
}
