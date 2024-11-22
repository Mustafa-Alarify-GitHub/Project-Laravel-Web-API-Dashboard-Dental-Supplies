<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Users_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function GetSupplier()
    {
        $data = User::where("type", "Admin Provider")
            ->orderByDesc("id")
            ->get();
        return view("Dashboard/MasterAdmin/Users/Supplier", ["data" => $data]);
    }
    public function GetClinic()
    {
        $data = User::where("type", "Clinic")
            ->orderByDesc("id")
            ->get();
        return view("Dashboard/MasterAdmin/Users/Clinic", ["data" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function Delete($id)
    {
        // return $id;
        User::where("id", $id)->delete();
        session()->flash("error", "the delete is Success");
        return  to_route("Supplier");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function Search(Request $request)
    {
        $data = DB::select("
        SELECT * FROM users  where name like '%$request->txt%'
        ");
        return view("Dashboard/MasterAdmin/Users/Supplier", ["data" => $data]);
    }

    public function GetRequestJoin()
    {
        $data = User::where("active", "0")->get();

        return view("Dashboard/MasterAdmin/Users/RequestJoin", ["data" => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updateRequestJoin( $id)
    {
        $user = User::where("id", $id)->first();

        if (!$user) {
            session()->flash("error", "This user is not found!");
            return to_route("join");
        }
        $user->update(["active"=>"1"]);
        session()->flash("error", "The Acceptable is Success");

        return to_route("join");

    }
    public function deleteRequestJoin( $id)
    {
        $user = User::where("id", $id)->first();

        if (!$user) {
            session()->flash("error", "This user is not found!");
            return to_route("join");
        }
        $user->delete();
        session()->flash("error", "The Acceptable is Success");

        return to_route("join");
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
