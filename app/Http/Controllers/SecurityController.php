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

    public function viewForgotPassword(Request $request)
    {
        if (!$request->session()->has('user')) {
            return view('forgot');
        } else {
            return redirect('home');
        }
    }

    public function viewRegister(Request $request)
    {
        if (!$request->session()->has('user')) {
            return view('register');
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

    public function formRegister(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "password_confirm" => "required",
        ]);
        $user = \App\User::where("email", $request->input("email"))->first();
        if ($user != null) {
            return response()->json([
                "message" => "User with email " . $user->email . " is exist",
            ], 400);
        } else {
            if ($request->input('password') != $request->input('password_confirm')) {
                return response()->json([
                    "message" => "Confirm password is different with provided password",
                ], 400);
            } else {
                $user = new \App\User();
                $user->name = $request->input("name");
                $user->email = $request->input("email");
                $user->password = Hash::make($request->input("password"));
                if ($user->save()) {
                    return response()->json([
                        "message" => "Register success, now you can login...",
                    ], 200);
                } else {
                    return response()->json([
                        "message" => "Failed to register new user",
                    ], 400);
                }
            }
        }
    }

    public function formLogout(Request $request)
    {
        $request->session()->flush();
        return redirect('login');
    }
}
