<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SecurityController extends Controller
{
    public function initSystem(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect('login');
        } else {
            return redirect('home');
        }
    }

    public function viewLogin(Request $request)
    {
        if (!$request->session()->has('user')) {
            return view('login');
        } else {
            return redirect('home');
        }
    }

    public function formLogin(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);
        $user = \App\User::where("email", $request->input("email"))->first();
        if ($user != null) {
            if (Hash::check($request->input('password'), $user->password)) {
                // Set Session
                $request->session()->put('user', $user->id);
                $request->session()->put('name', $user->name);
                $request->session()->put('email', $user->email);

                return response()->json([
                    "message" => "Success login",
                ], 200);
            } else {
                return response()->json([
                    "message" => "Username or password is wrong",
                ], 401);
            }
        } else {
            return response()->json([
                "message" => "Username or password is wrong",
            ], 401);
        }
    }

    public function formLogout(Request $request)
    {
        $request->session()->flush();
        return redirect('login');
    }
}
