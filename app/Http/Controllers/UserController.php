<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //Show Register/Create Form
    public function create(){
return view('users.register');
    }

    //store user in db
    public function store(Request $request){

        $formFields=$request->validate([
"name"=>["required","min:3"],
"email"=>["required","email",Rule::unique("users","email")],
"password"=>["required","min:6","confirmed"],

        ]);
    $formFields["password"]=bcrypt($formFields["password"]);
    $user="";
    $user=User::create($formFields);
  
    Auth::login($user);
    return redirect ("/")->with("message","User created successfully");
    }


public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect("/")->with("message","You have been logged out");
}

public function login(){
    return view("users.login");
}

public function loginCheck(Request $request){
$formFields=$request->validate([
    "email"=>["required","email"],
"password"=>["required"]
]);


if (Auth::attempt(array("email"=>$formFields["email"],"password"=>$formFields["password"]))){ 
    $request->session()->regenerate();
return redirect("/")->with("message","Login Success!"); 
}

return back()->withErrors(['email'=>'Invalid Credentials'])->onlyInput('email');
}
}
