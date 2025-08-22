<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function check(Request $request){
        $candidate = $request->only('email', 'password');
        $remember = $request->filled('remember'); 

        if (Auth::attempt($candidate, $remember)) {
            return redirect()->route('home');
        }
        return redirect()->back()->withErrors(['errors'=>'login is failed;']);
    }
}
