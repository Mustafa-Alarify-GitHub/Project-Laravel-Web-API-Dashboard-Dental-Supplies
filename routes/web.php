<?php

use App\Http\Controllers\Auth_Controller;
use App\Http\Controllers\Balance_Controller;
use App\Http\Controllers\Delivery_Controller;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\HomeDashboard_Controller;
use App\Http\Controllers\Product_Controller;
use App\Http\Controllers\Profile_Controller;
use App\Http\Controllers\Report_Controller;
use App\Http\Controllers\Sales_Controller;
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

    // Request Join user
    Route::get("Get-Request-Join", [Users_Controller::class, "GetRequestJoin"])->name("join");
    Route::put("Get-Request-Join/{id}", [Users_Controller::class, "updateRequestJoin"])->name("update.join");
    Route::delete("Get-Request-Join/{id}", [Users_Controller::class, "deleteRequestJoin"])->name("delete.join");

    // Request Add Product
    Route::get("Get-Request-Product", [Product_Controller::class, "GetRequestProduct"])->name("Product");
    Route::put("Get-Request-Product/{id}", [Product_Controller::class, "updateRequestProduct"])->name("update.Product");
    Route::delete("Get-Request-Product/{id}", [Product_Controller::class, "deleteRequestProduct"])->name("delete.Product");

    Route::resource("product", Product_Controller::class);
    Route::resource("Balance", Balance_Controller::class);
    Route::resource("Hero", HeroController::class);
});

// Provide Admin
Route::middleware(['auth', 'ProvideAdmin'])->group(function () {
    Route::get("Get-All-product-By-Supplies", 
    [Product_Controller::class, "productBySupplies"])->name("Product.Supplies");
   
    Route::get("get-All-product-By-Supplies-status", 
    [Product_Controller::class, "getAllProductByID"])->name("Product.Supplies.status");

    Route::get("Add-All-product-By-Supplies", 
    [Product_Controller::class, "addNewProduct"])->name("Product.Supplies.create");

    Route::post("Add-product-By-Supplies", 
    [Product_Controller::class, "storeNewProduct"])->name("Product.Supplies.Add");
    Route::get("Update-product/{id}", 
    [Product_Controller::class, "editProduct"])->name("Product.Supplies.edit");
    Route::put("Update-product/{id}", 
    [Product_Controller::class, "updateProduct"])->name("Product.Supplies.update");

    Route::delete("Det-All-product-By-Supplies/{id}", 
    [Product_Controller::class, "deleteProduct"])->name("Product.Supplies.delete");

    // Purchases
    Route::get("/Get-All-Purchases",[Sales_Controller::class,"getAllPurchases"])->name("Purchases");

    // Deliveries
    Route::resource('Delivery', Delivery_Controller::class);
    Route::get("/get-product-Order",[Delivery_Controller::class,"getProductOrder"])->name("product.Order");
    Route::put("/put-product-Order",[Delivery_Controller::class,"UpdateDeliveryStatus"])->name("product.Order.status");

    // Report Delivery
    Route::get("/REPO-Delivery",[Report_Controller::class,"deliveryReportAll"])->name("delivery.index");
    Route::post("/REPO-Delivery",[Report_Controller::class,"deliveryReportByOneDelivery"])->name("delivery.show");

    // Report Purchases
    Route::get("/REPO-Purchases",[Report_Controller::class,"PurchasesReportAll"])->name("Purchases.index");
    Route::post("/REPO-Purchases",[Report_Controller::class,"PurchasesReportByTime"])->name("Purchases.show");

    // print PDF
    Route::post("/PDF-Purchases",[Report_Controller::class,"PDFPurchases"])->name("Purchases.PDF");
    Route::post("/PDF-Delivery",[Report_Controller::class,"PDFDelivery"])->name("Delivery.PDF");

});

// Global Autonation
Route::middleware('auth')->group(function () {
    Route::get("/", [HomeDashboard_Controller::class, "index"])->name("home");

    // Profile
    Route::resource("Profile", Profile_Controller::class);

    // Log out
    Route::post("/logout", [Auth_Controller::class, "LogOut"])->name("logout");
});
