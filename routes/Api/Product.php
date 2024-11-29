<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Get All products by Id User
Route::get("/Get-User-product/{id}", function ($id) {
    $data = Product::where('Manger_Id', $id)
    ->inRandomOrder()
    ->where("counter", ">", 0)
    ->where("status", "Active")
    ->limit(6)
    ->get();

    return response()->json([
        "status" => "200",
        "message" => "Success",
        "data" => $data,
    ]);
});

// Get All products 
Route::get("/Get-All-product", function () {
    $data = Product::where("status", "Active")
    ->where("counter", ">", 0)
    ->where("status", "Active")
    ->inRandomOrder()
    ->get();
    
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
