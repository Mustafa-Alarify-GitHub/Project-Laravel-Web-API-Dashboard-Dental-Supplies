<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Balance_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where("type", "Clinic")->get();
        return view('Dashboard/MasterAdmin/Users/Balance', ["data" => $data]);
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
        $request->validate([
            "clinic" => "required",
            "balance" => "required|numeric|min:0",
        ]);

        $user = User::where('id', "$request->clinic_id")->first();
        if (!$user) {
            session()->flash("error", "This User is Not Found!");
            return to_route("Balance.index");
        }

        $user->update([
            "stock" => ($request->balance + $user->stock)
        ]);

        session()->flash("success", "The Add Is Success");
        return to_route("Balance.index");
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
