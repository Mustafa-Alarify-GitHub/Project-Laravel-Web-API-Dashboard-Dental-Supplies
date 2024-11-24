<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class Product_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::where("status","Active")->get();
        return view("Dashboard.MasterAdmin.Product.Product", ["data" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Product::where("Manger_Id", "=", $id)->get();

        return view("Dashboard/MasterAdmin/Product/Product", ["data" => $data]);
    }

    public function GetRequestProduct()
    {
        $data = Product::where("status", "Wait")->get();

        return view("Dashboard/MasterAdmin/Product/RequestProduct", ["data" => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updateRequestProduct(Request $request, $id)
    {
        $product = Product::where("id", $id)->first();

        if (!$product) {
            session()->flash("error", "This user is not found!");
            return to_route("Product");
        }
        // $product->update(["active" => "1"]);
        session()->flash("error", "The Acceptable is Success");

        return to_route("Product");
    }
}
