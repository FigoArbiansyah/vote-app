<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view("main.pages.auth.login");
    }

    public function register() {
        return view("main.pages.auth.register");
    }

    public function submitLogin(Request $request) {
        $this->validate($request, [
            "email" => "required|email",
            "password" => "required"
        ]);

        $credentials = $request->only("email", "password");
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended("/");
        }
        return back()->withInfo("Gagal untuk login!");
    }

    public function submitRegister(Request $request) {
        $this->validate($request, [
            "name" => "required",
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = "user";
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect("/login")->withInfo("Berhasil register, silahkan login!");
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/login");
    }
}
