<?php

namespace App\Http\Controllers;

use App\Models\bill;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Sales_Controller extends Controller
{
    public function getAllPurchases()
    {
        $data = DB::select("
        SELECT 
            products.name,
            products.image,
            sales.counter,
            sales.Order,
            sales.StatusOrder,
            sales.created_at,
            products.price_sales,
            products.price_buy,
            ((products.price_sales - products.price_buy)*sales.counter) as Balance
        FROM sales
        INNER JOIN products
        ON sales.product_Id = products.id
        AND products.Manger_Id = ?
         ORDER BY sales.id DESC
    ", [Auth()->user()->id]);

    $total_Balance=0;
        for ($i = 0; $i < count($data); $i++) {
            $total_Balance +=$data[$i]->Balance;
        }

        return view("Dashboard/ProviderAdmin/Purchases/Purchases",
         [
            "data" => $data,
            "total_Balance" => $total_Balance,
        ]);
    }
}
