<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $form_data = $request->validate([
            "name" => ["required", "min:3", "max:15", Rule::unique("users", "name")],
            "password" => ["required", "min:8", "max:255"]
        ]);

        $form_data["name"] = strip_tags($form_data["name"]);
        $form_data["password"] = bcrypt($form_data["password"]);
        $form_data["email"] = "none";

        $user = User::create($form_data);
        auth()->login($user);

        return redirect("/");
    }

    public function login(Request $request)
    {
        $form_data = $request->validate([
            "name" => "required",
            "password" => "required"
        ]);

        if (auth()->attempt(["name" => $form_data["name"], "password" => $form_data["password"]])) {
            $request->session()->regenerate();
        } else {
            redirect()->back();
        }

        return redirect("/");
    }

    public function logout()
    {
        @auth()->logout();

        return redirect("/");
    }
}