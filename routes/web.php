<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

Route::get('/', [ListingController::class,"index"]);

Route::get('listings/{listing}', [ListingController::class,"show"]);
