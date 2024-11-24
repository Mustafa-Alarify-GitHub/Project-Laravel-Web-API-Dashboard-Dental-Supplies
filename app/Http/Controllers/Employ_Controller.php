<?php

namespace App\Http\Controllers;

use App\Models\emploes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Employ_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = emploes::where("Manger_Id",Auth()->user()->id)->get();
        return view("Dashboard/ProviderAdmin/Employs/Emploies",["data"=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Dashboard/ProviderAdmin/Employs/AddEmploy");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "email" => "required|email|min:4",
            "password" => "required|min:8",
            "name" => "required|string",
            "phone" => "required|max:9",
        ]);

        // Check Email is Already existing
        $userEmp = emploes::where("email", $request->email)->first();
        $user = User::where("email", $request->email)->first();

        if ($user || $userEmp) {
            session()->flash("error", "هذا البريد الإلكتروني مسجل مسبقاً.");
            return to_route("Employ.create");
        }

        // Hash password
        $hashedPassword = Hash::make($request->password);

        // Create the user in the database
        $user = emploes::create([
            'email' => $request->email,
            'password' => $hashedPassword,
            'name' => $request->name,
            'phone' => $request->phone,
            'Manger_Id' => Auth()->user()->id,
        ]);


        return to_route("Employ.index");

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
    public function destroy($id)
    {
        $employ = emploes::where("id",$id)->first();
        if (!$employ) {
            session()->flash("error", "this employs is not found!");
            return to_route("Employ.index");
        }
        $employ->delete(); 
        session()->flash("error", "The delete is Successfully");
        return to_route("Employ.index");
    }
}
