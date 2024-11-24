<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeDashboard_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allProduct =Product::count();
        $ActiveProduct =Product::where("status","Active")->count();
        $unActiveProduct =Product::where("status","UnActive")->count();
        $allClinic =User::where("type","Clinic")->count();
        $allSupplier =User::where("type","Admin Provider")->count();
        $Balance =User::where("id",Auth()->user()->id)->first();


        return view("Dashboard/Home",[
            "allProduct"=>$allProduct,
            "allClinic"=>$allClinic,
            "allSupplier"=>$allSupplier,
            "Balance"=>$Balance->stock,
            "ActiveProduct"=>$ActiveProduct,
            "unActiveProduct"=>$unActiveProduct,
        ]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
