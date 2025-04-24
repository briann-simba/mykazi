<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class ListingController extends Controller
{
//Show all listings
    public function index(){
        //dd(request("tag"));
        $listings=Listing::latest()->filter(request(["tag","search"]))->get();
        return view('listings.index',["listings"=>$listings]);
    }
//Show single listing
    public function show(Listing $listing){
        return view('listings.show',["listing"=>$listing]);
    }

    //Show create listing form
        public function create(){
        return view('listings.create',[]);
    }

    public function store(Request $request){
        $formFields=$request->validate([
            "title"=>'required',
            "company"=>["required",Rule::unique("listings","company")],
            "location"=>"required",
            "email" => ["required","email"],
            "website"=>"required",
            "tags"=>"required",
            "description"=> "required"
        ]);

        Listing::create($formFields);

        return redirect("/")
        ->with('message','Listing created successfully!');
    }
}
