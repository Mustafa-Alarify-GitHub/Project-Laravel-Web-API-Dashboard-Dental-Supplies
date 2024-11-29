<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class Product_Controller extends Controller
{
    // get All product ==> Master Admin
    public function index()
    {
        $data = Product::where("status", "Active")->get();
        return view("Dashboard.MasterAdmin.Product.Product", ["data" => $data]);
    }

    // Open Page Add New product product ==> Provider Admin
    public function addNewProduct()
    {
        return view("Dashboard/ProviderAdmin/Product/AddNewProduct");
    }
    public function show(string $id)
    {
        $data = Product::where("Manger_Id", "=", $id)->get();
        return view("Dashboard/MasterAdmin/Product/Product", ["data" => $data]);
    }
    public function GetRequestProduct()
    {
        $data = Product::where("status", "Wait")
            ->orderByDesc("id")->get();
        return view("Dashboard/MasterAdmin/Product/RequestProduct", ["data" => $data]);
    }
    public function updateRequestProduct($id)
    {
        $product = Product::where("id", $id)->first();

        if (!$product) {
            session()->flash("error", "This user is not found!");
            return to_route("Product");
        }
        $product->update(["status" => "Active"]);
        session()->flash("error", "The Acceptable is Success");

        return to_route("Product");
    }
    public function deleteRequestProduct($id)
    {
        $product = Product::where("id", $id)->first();

        if (!$product) {
            session()->flash("error", "This product is not found!");
            return to_route("join");
        }

        echo "
        <script>
        
        </script>
        ";
        $product->delete();
        session()->flash("success", "The product is UnAcceptable ");

        return to_route("Product");
    }
    public function productBySupplies()
    {
        $data = Product::where("Manger_Id", Auth()->user()->id)
            ->orderByDesc("id")
            ->where("status", "Active")
            ->get();

        return view("Dashboard/ProviderAdmin/Product/Product", ["data" => $data]);
    }
    public function deleteProduct($id)
    {
        $product = Product::where("id", $id)->first();
        if (!$product) {
            session()->flash("error", "this product is not found!");
            return to_route("Product.Supplies");
        }
        $product->delete();
        session()->flash("error", "the delete is Success");
        return to_route("Product.Supplies");
    }
    public function storeNewProduct(Request $request)
    {
        $request->validate([
            "name"          => "required|min:2",
            "image"         => "required",
            "modeType"      => "required|min:2",
            "price_buy"     => "required|numeric|min:0",
            "price_sales"   => "required|numeric|min:0",
            "counter"       => "required|numeric|min:0",
            "description"   => "required|min:5",
        ]);

        $img_path = $request->file('image')->store('', 'Images_Product');

        Product::create([
            "name"          => $request->name,
            "image"         => 'ImagesProduct' . '/' . $img_path,
            "modeType"      => $request->modeType,
            "price_buy"     => $request->price_buy,
            "price_sales"   => $request->price_sales,
            "counter"       => $request->counter,
            "description"   => $request->description,
            "status"        => "Wait",
            "Manger_Id"    =>  Auth()->user()->id,
        ]);

        session()->flash("success", "The Created is Successfully.");
        return to_route("Product.Supplies");
    }
    public function getAllProductByID()
    {
        $data = Product::where("Manger_Id", Auth()->user()->id)
            ->orderByDesc("id")
            ->get();

        return view("Dashboard/ProviderAdmin/Product/StatusProduct", ["data" => $data]);
    }
    public function editProduct($id)
    {
        $product = Product::where("id", $id)->first();
        if ($product) {
            return view("Dashboard/ProviderAdmin/Product/UpdateProduct", ["data" => $product]);
        }
        return to_route("Product.Supplies");
    }
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            "name"          => "required|min:2",
            "modeType"      => "required|min:2",
            "price_buy"     => "required|numeric|min:0",
            "price_sales"   => "required|numeric|min:0",
            "counter"       => "required|numeric|min:0",
            "description"   => "required|min:5",
        ]);
        Product::where("id", $id)->update([
            "name"          => $request->name,
            "modeType"      => $request->modeType,
            "price_buy"     => $request->price_buy,
            "price_sales"   => $request->price_sales,
            "counter"       => $request->counter,
            "description"   => $request->description,
        ]);
        session()->flash("success", "The Update is Successfully.");

        return to_route("Product.Supplies");
    }
}
