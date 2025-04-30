<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
//show all listings
Route::get('/', [ListingController::class,"index"])->name("listings.index");

//Actually Update Listing
Route::put("/listings/{listing}", [ListingController::class,"update"])->middleware('auth');

//Delete a listing
Route::delete("/listings/{listing}", [ListingController::class,"destroy"])->middleware('auth');

//show create listing form
Route::get('/listings/create', [ListingController::class,"create"])->middleware('auth');

//show Register/Create Form
Route::get('/register',[UserController::class, 'create'])->middleware('guest');

//store user data
Route::post('/users',[UserController::class, 'store']);

//logout a user
Route::post("/logout",[UserController::class,"logout"])->middleware('auth');

//show login form
Route::get("/login",[UserController::class,"login"])->name('login')->middleware('guest');

//login check
Route::post("/loginCheck",[UserController::class,"loginCheck"]);

//store listing data
Route::post('/listings', [ListingController::class,"store"])->middleware('auth');

//show single listing
Route::get('/listings/{listing}', [ListingController::class,"show"])->name('listings.show');

//show edit listing form
Route::get("/listings/{listing}/edit", [ListingController::class,"edit"])->middleware('auth');



