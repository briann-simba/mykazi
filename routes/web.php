<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;

Route::get('listings', function () {
$listings=Listing::all();
    return view('welcome',["listings"=>$listings]);
});

Route::get('listings/{listing}', function (Listing $listing) {
    
    
        return view('list',["listing"=>$listing]);
    });
