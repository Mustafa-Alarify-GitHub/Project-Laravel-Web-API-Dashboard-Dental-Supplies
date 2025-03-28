<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Get All Clinic
Route::get("/Get-All-Clinic", function () {
    $data = User::where('type', "Admin Provider")
    ->where('active', "1")
    ->inRandomOrder()->get();
    return response()->json([
        "status" => "200",
        "message" => "Success",
        "data" => $data,
    ]);
});
