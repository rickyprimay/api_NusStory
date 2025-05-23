<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.authentication.login');
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        if (Auth::attempt($request->only('email', 'password'))) {

            $user = Auth::user();

            session([
                'user_name' => $user->name,
            ]);

            return redirect()->route('dashboard')->with('success_toast', 'Login successful');
        }

        return redirect()->back()->with('error_toast', 'Email atau password salah');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
