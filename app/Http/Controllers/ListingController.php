<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
//Show all listings
    public function index(){
        //dd(request("tag"));
        $listings=Listing::latest()->filter(request(["tag"]))->get();
        return view('listings.index',["listings"=>$listings]);
    }
//Show single listing
    public function show(Listing $listing){
        return view('listings.show',["listing"=>$listing]);
    }
}
