<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

Route::get('/', [ListingController::class,"index"]);


//show create listing form
Route::get('listings/create', [ListingController::class,"create"]);
Route::get('listings/{listing}', [ListingController::class,"show"]);
