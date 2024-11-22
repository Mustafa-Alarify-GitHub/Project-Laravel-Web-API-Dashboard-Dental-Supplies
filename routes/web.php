<?php

use App\Http\Controllers\Auth_Controller;
use App\Http\Controllers\Balance_Controller;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\HomeDashboard_Controller;
use App\Http\Controllers\Product_Controller;
use App\Http\Controllers\Profile_Controller;
use App\Http\Controllers\Users_Controller;
use Illuminate\Support\Facades\Route;


// Guest
Route::middleware('guest')->group(function () {
    Route::view("/Wait", "Auth/Wait")->name("wait");
    Route::view("/Login", "Auth/login")->name("login");
    Route::view("/Register", "Auth/Register")->name("Register");
    Route::post("/Register", [Auth_Controller::class, "Register"])->name("RegisterUser");
    Route::post("/Login", [Auth_Controller::class, "Login"])->name("LoginUser");
});

// Master Admin
Route::middleware(['auth', 'MAdmin'])->group(function () {

    // Users
    Route::get("Get-Supplier", [Users_Controller::class, "GetSupplier"])->name("Supplier");
    Route::get("Get-Clinic", [Users_Controller::class, "GetClinic"])->name("Clinic");
    Route::post("Search", [Users_Controller::class, "Search"])->name("Search");
    Route::delete("Get-Supplier/{id}", [Users_Controller::class, "Delete"])->name("deleteUser");

    // Request Join
    Route::get("Get-Request-Join", [Users_Controller::class, "GetRequestJoin"])->name("join");
    Route::put("Get-Request-Join/{id}", [Users_Controller::class, "updateRequestJoin"])->name("update.join");
    Route::delete("Get-Request-Join/{id}", [Users_Controller::class, "deleteRequestJoin"])->name("delete.join");

    // Product
    Route::resource("product", Product_Controller::class);
    Route::resource("Balance", Balance_Controller::class);
    Route::resource("Hero", HeroController::class);
});

// Provide Admin
Route::middleware(['auth', 'ProvideAdmin'])->group(function () {});

Route::middleware('auth')->group(function () {
    Route::get("/", [HomeDashboard_Controller::class, "index"])->name("home");

    // Profile
    Route::resource("Profile", Profile_Controller::class);

    // Log out
    Route::post("/logout", [Auth_Controller::class, "LogOut"])->name("logout");
});
