<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }


    public function authenticate(Request $request) {

        $user = User::where('email', $request->email)->first();

        if (!is_null($user)) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('indexxx');
            }
        }

        return redirect()->back();
    }

    public function logout()
    {
        session()->forget('jwt-token');
        return redirect()->route('login');
    }

}
