<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Auth_Controller extends Controller
{

    public function Register(Request $request)
    {
        $request->validate([
            "email" => "required|email|min:4",
            "password" => "required|min:8",
            "name_company" => "required|string|min:4|max:35",
            "name" => "required|string",
            "phone" => "required|max:9",
            "Location" => "required",
        ]);

        // Check Email is Already existing
        $user = User::where("email", $request->email)->first();

        if ($user) {
            session()->flash("error", "هذا البريد الإلكتروني مسجل مسبقاً.");
            return to_route("Register");
        }

        // Hash password
        $hashedPassword = Hash::make($request->password);

        // Create the user in the database
        $user = User::create([
            'email' => $request->email,
            'password' => $hashedPassword,
            'name_company' => $request->name_company,
            'name' => $request->name,
            'phone' => $request->phone,
            'Location' => $request->Location,
            'type' => "Admin Provider",
        ]);


        return to_route("wait");
    }
    public function Login(Request $request)
    {
        $request->validate([
            "email" => "required|email|min:4",
            "password" => "required|string|min:4",
        ]);

        // Check Email is Already existing
        $user = User::where("email", $request->email)
            ->where("type", "!=", "Clinic")
            ->first();

        if (!$user) {
            session()->flash("error", "هذا البريد الإلكتروني غير موجود");
            return to_route("login");
        }

        if (!Hash::check($request->password, $user->password)) {
            session()->flash("error", "البريد الإلكتروني أو كلمة المرور غير صحيحة");
            return to_route("login");
        }
        
        if ($user->active == true) {
            Auth()->login($user);
            return to_route("home");
        }

        return to_route("wait");
    }
    public function LogOut(Request $request)
    {
        Auth()->logout();
        return to_route("login");
    }
}
