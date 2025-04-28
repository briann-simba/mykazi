<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    User::create($formFields);
    return redirect ("/")->with("message","User created successfully");
    }
}
