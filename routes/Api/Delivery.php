<?php

use App\Models\Delavery;
use App\Models\Delivery_report;
use App\Models\Hero;
use App\Models\Sales;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Get verify code with Delivery
Route::get("/Get-Verify-Code/{id}", function ($id) {
    $data = Delivery_report::where("bill_id", $id)->get();
    return response()->json([
        "status" => "200",
        "message" => "Success",
        "data" => $data,
    ]);
});

// Change Status Code with Delivery
Route::post("/Change-Delivery-Status/{id}", function (Request $request, $id) {
    Delavery::where("id", $id)->update([
        "status" => $request->status
    ]);
    return response()->json([
        "status" => "200",
        "message" => "Success",
    ]);
});

// Get Order By Deliver
Route::get("/Get-orderby-delivery/{id}", function ($id) {
    $data = Sales::where("deliver_id", $id)
    ->where("StatusOrder", "B")
    ->get();
    return response()->json([
        "status" => "200",
        "message" => "Success",
        "data" => $data,
    ]);
});
