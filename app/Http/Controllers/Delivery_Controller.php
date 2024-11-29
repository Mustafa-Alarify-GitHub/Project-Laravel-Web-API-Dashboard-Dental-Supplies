<?php

namespace App\Http\Controllers;

use App\Models\bill;
use App\Models\Delavery;
use App\Models\Delivery_report;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Delivery_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Delavery::where("Manger_Id", Auth()->user()->id)->get();
        return view(
            "Dashboard/ProviderAdmin/Delivery/Delivery",
            ["data" => $data]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Dashboard/ProviderAdmin/Delivery/Adddelivery");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required|min:8",
        ]);

        $hashPassword = Hash::make($request->password);

        Delavery::create([
            "name"      => $request->name,
            "email"     => $request->email,
            "password"  => $hashPassword,
            "status"    => "OffLine",
            "Manger_Id" => Auth()->user()->id,
        ]);
        session()->flash("success", "The Delete is Successfully.");
        return to_route("Delivery.index");
    }

    /**
     * Display the specified resource.
     */
    public function UpdateDeliveryStatus(Request $request)
    {

        $salles = Sales::where("id", $request->id_Sales)->first();
        $salles->update([
            "StatusOrder" => "B",
            "deliver_id" => $request->id_delivery,
        ]);;
        // update Delivery status
        Delavery::where("id", $request->id_delivery)->update([
            "status" => "Busy"
        ]);
        // get id Clinic for Bill
        $bill = bill::where("id", $salles->Bill_Id)->first();

        // set data in table  Delivery report
        Delivery_report::create([
            "Delivery_Id" => $request->id_delivery,
            "Clinic_Id" => $bill->Clinic_Id,
            "status" => "Underway",
            "bill_id" => $bill->id,
        ]);

        session()->flash("success", "The Update is Successfully.");
        return to_route("product.Order");
    }
    public function getProductOrder()
    {
        $data = DB::select("
       SELECT 
            products.name,
            products.image,
            sales.id,
            sales.counter,
            sales.Order,
            sales.StatusOrder,
            sales.created_at,
            products.price_sales,
            products.price_buy,
            delaveries.name as 'delivaryName',
            ((products.price_sales - products.price_buy) * sales.counter) as Balance
        
        FROM 
            sales
        INNER JOIN 
            products ON sales.product_Id = products.id
        LEFT JOIN 
            delaveries ON sales.deliver_id = delaveries.id
        WHERE 
            products.Manger_Id = ?
            AND sales.Order != 0
        ORDER BY 
            sales.id DESC;

    ", [Auth()->user()->id]);

        $deliveries = Delavery::where("status", "Online")
            ->where("Manger_Id", Auth()->user()->id)
            ->get();

        return view(
            "Dashboard/ProviderAdmin/Delivery/DeliveryProduct",
            [
                "data" => $data,
                "deliveries" => $deliveries,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Delavery::where("id", $id)->first();
        return view(
            "Dashboard/ProviderAdmin/Delivery/Updatedelivery",
            ["data" => $data]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required",
            "password" => "required|min:8",
        ]);
        $hashPassword = Hash::make($request->password);

        Delavery::where("id", $id)->update([
            "name"      => $request->name,
            "password"  => $hashPassword,
        ]);

        session()->flash("success", "The Update is Successfully.");
        return to_route("Delivery.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Delavery::where("id", $id)->delete();
        session()->flash("success", "The Delete is Successfully.");
        return to_route("Delivery.index");
    }
}
