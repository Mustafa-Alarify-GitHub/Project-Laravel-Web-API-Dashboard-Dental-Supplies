<?php

use App\Models\Hero;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Home Api
Route::get("/Get-Data-Home", function () {
    $heroes = Hero::where('end_time', '>', Carbon::now())->get();
    $data = User::where('active', "1")
    ->where('type', "Admin Provider")
    ->distinct()->inRandomOrder()->limit(4)->get();
    return response()->json([
        "status" => "200",
        "message" => "",
        "heroes" => $heroes,
        "data" => $data,
    ]);
});


Route::get("/Search/{txt}", function ($txt) {
    $data = DB::select("
        SELECT * FROM products WHERE name LIKE ?
    ", ["%$txt%"]);
    return response()->json([
        "status" => "200",
        "message" => "Success",
        "data" => $data,
    ]);
});

