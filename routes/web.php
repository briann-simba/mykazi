<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
//show all listings
Route::get('/', [ListingController::class,"index"]);

//Actually Update Listing
Route::put("/listings/{listing}", [ListingController::class,"update"]);

//show create listing form
Route::get('/listings/create', [ListingController::class,"create"]);

//store listing data
Route::post('/listings', [ListingController::class,"store"]);

//show single listing
Route::get('/listings/{listing}', [ListingController::class,"show"]);

//show edit listing form
Route::get("/listings/{listing}/edit", [ListingController::class,"edit"]);



