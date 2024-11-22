<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = DB::select("
            SELECT *, CASE WHEN end_time < NOW() THEN '0' ELSE '1' END AS Active 
            FROM heroes 
            ORDER BY id DESC
");

        return view("Dashboard/MasterAdmin/Product/Hero", ["data" => $data]);
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
            "end_time" => "required|date",
            "image" => "required",
        ]);

        $img_path = $request->file('image')->store('', 'Images_Hero');

        Hero::create([
            "end_time" => $request->end_time,
            "image" => "/ImagesHero/" . $img_path,
        ]);
        session()->flash("success", "The Created is Successfully.");
        return to_route("Hero.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Hero $hero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hero $hero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hero $hero)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hero = Hero::where('id', $id)->first();
        if ($hero) {
            $hero->delete();
            session()->flash("success", "The Delete is Successfully.");
            return to_route("Hero.index");
        }
        session()->flash("error", "The Hero is not found!");
        return to_route("Hero.index");
    }
}
