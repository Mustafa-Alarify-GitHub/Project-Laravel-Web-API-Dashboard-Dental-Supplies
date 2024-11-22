<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Profile_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where("id", Auth()->user()->id)->first();
        return view("Dashboard/Profile", ["data" => $data]);
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
    public function edit($id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "phone" => "required|max:9",
            "location" => "required",
        ]);

        $user = User::where("id", Auth()->user()->id)->first();

        if (!$user) {
            session()->flash("error", "This user is not found!");
            return to_route("Profile.index");
        }
        if ($request->image != null) {
            $img_path = $request->file('image')->store('', 'Images');
            $user->update(["image" => 'ImagesProfile/' . $img_path]);
        }
        $user->update([
            "name"      => $request->name,
            "phone"     => $request->phone,
            "Location"  => $request->location,
        ]);
        session()->flash("success", "The Update is Success.");
        return to_route("Profile.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
