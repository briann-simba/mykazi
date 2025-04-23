<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

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
}
