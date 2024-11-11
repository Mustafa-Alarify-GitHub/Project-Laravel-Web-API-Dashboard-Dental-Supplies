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

// Get All products by Id User
Route::get("/Get-User-product/{id}", function ($id) {
    $data = Product::where('Manger_Id', $id)->inRandomOrder()->limit(6)->get();
    return response()->json([
        "status" => "200",
        "message" => "Success",
        "data" => $data,
    ]);
});

// Get All products 
Route::get("/Get-All-product", function () {
    $data = Product::inRandomOrder()->get();
    return response()->json([
        "status" => "200",
        "message" => "Success",
        "data" => $data,
    ]);
});

// Get product by Id 
Route::get("/Get-product/{id}", function ($id) {
    $data = Product::where('id', $id)->get();
    return response()->json([
        "status" => "200",
        "message" => "Success",
        "data" => $data,
    ]);
});
