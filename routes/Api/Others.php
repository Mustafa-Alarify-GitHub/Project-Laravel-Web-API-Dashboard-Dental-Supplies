<?php

use App\Models\Delavery;
use App\Models\Delivery_report;
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

// Search
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

// Get Clinic Request 
Route::get("/Get-Request-Clinic/{id}", function ($id) {
    $data = DB::select("
    SELECT
        sales.Bill_Id,
        SUM(sales.total_price) AS total_price,
        MAX(sales.StatusOrder) AS StatusOrder,
        bills.Clinic_Id,
        MAX(bills.created_at) AS created_at
    FROM
        sales
    INNER JOIN bills ON bills.id = sales.Bill_Id
    WHERE
        bills.Clinic_Id = ?
    GROUP BY
        sales.Bill_Id, bills.Clinic_Id
    ORDER BY
        bills.id DESC
", [$id]);


    return response()->json([
        "status" => "200",
        "message" => "Success",
        "data" => $data,
    ]);
});

// Get data for Bill
Route::post("/Get-data-bill", function (Request $request) {
    $data = DB::select(
        "
SELECT
    products.name,
    products.image,
    products.price_buy,
    sales.counter,
    (
        sales.counter * products.price_buy
    ) AS 'total_price'
FROM
    sales
INNER JOIN products ON products.id = sales.product_Id
INNER JOIN bills ON bills.id = sales.Bill_Id
WHERE
    bills.Clinic_Id = ?
    AND
     sales.Bill_Id = ?;",
        [$request->user_id, $request->bill_id]
    );

    return response()->json([
        "status" => "200",
        "message" => "Success",
        "data" => $data,
    ]);
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
