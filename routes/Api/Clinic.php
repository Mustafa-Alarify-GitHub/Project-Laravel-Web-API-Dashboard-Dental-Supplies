<?php

use App\Models\book;
use App\Models\Hero;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Get All Clinic
Route::get("/Get-All-Clinic", function () {
    $data = User::where('type', "Admin Provider")->inRandomOrder()->get();
    return response()->json([
        "status" => "200",
        "message" => "Success",
        "data" => $data,
    ]);
});

// Home Api
Route::get("/Get-Data-Home", function () {
    $heroes = Hero::where('end_time', '>', Carbon::now())->get();
    $data = User::where('type', "Admin Provider")->distinct()->inRandomOrder()->limit(4)->get();
    return response()->json([
        "status" => "200",
        "message" => "",
        "heroes" => $heroes,
        "data" => $data,
    ]);
});
