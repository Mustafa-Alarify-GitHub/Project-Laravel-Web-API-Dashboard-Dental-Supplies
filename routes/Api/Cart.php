<?php

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Get All Data in Cart
Route::get("/Cart/{id}", function ($id) {


    $user = User::where('id', $id)->first();

    if (!$user) {
        return response()->json([
            "status" => "404",
            "message" => "This User not Found!",
        ]);
    }

    $data = DB::select("
        SELECT
            products.id as 'products_id',
            products.name,
            products.modeType,
            products.image,
            products.price_buy,
            products.counter,
            carts.quantity,
            carts.product_Id  as 'id'
        FROM
            carts
        INNER JOIN users ON carts.user_Id  = users.id
        INNER JOIN products ON carts.product_Id  = products.id
        WHERE
            users.id = $id");

            

    return response()->json([
        "status" => "200",
        "message" => "Success",
        "data" => $data
    ]);
});

// Add to cart
Route::post("/Add-To-Card", function (Request $request) {

    // check user 
    $user = User::where("id", $request->idUser)->first();

    if (!$user) {
        return response()->json([
            "status" => "404",
            "message" => "هذا المستخدم غير موجود",
        ]);
    }

    // check product 
    $product = Product::where('id', $request->product_id)
        ->where('counter', '>', 0)
        ->first();

    if (!$product) {
        return response()->json([
            "status" => "404",
            "message" => "هذا العنصر غير موجود.",
        ]);
    }

    // Check In The Cart 
    $cartItem = Cart::where('user_id', $user->id)
        ->where('product_id', $product->id)
        ->first();

    // Check Count
    if ($cartItem) {

        // increment
        if ($request->target == "increment") {
            if ($cartItem->quantity < $product->counter) {
                $cartItem->quantity += 1;
                $cartItem->save();

                return response()->json([
                    "status" => "200",
                    "message" => "تم تحديث الكمية بنجاح.",
                ]);
            }
            return response()->json([
                "status" => "200",
                "message" => "عذرًا، لا يمكن إضافة المزيد. لقد وصلت إلى الحد الأقصى للكمية المتاحة.",
            ]);
        }
        // Decrement
        if ($cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();

            return response()->json([
                "status" => "200",
                "message" => "تم تحديث الكمية بنجاح.",
            ]);
        }
        return response()->json([
            "status" => "200",
            "message" => "عذرًا، لا يمكن تقليل الكمية أكثر. لقد وصلت إلى الحد الأدنى للكمية المتاحة.",
        ]);
    }

    Cart::create([
        'user_Id' => $user->id,
        'product_Id' => $product->id
    ]);
    return response()->json([
        "status" => "200",
        "message" => "تم إضافة المنتج إلى السلة بنجاح.",
    ]);
});

// Remove from Cart
Route::post("/Cart/{id}", function ($id, Request $request) {

    // check user 
    $user = User::where("id", $request->idUser)->first();

    if (!$user) {
        return response()->json([
            "status" => "404",
            "message" => "هذا المستخدم غير موجود",
        ]);
    }

    // check product 
    $cartItem = Cart::where('user_id', $user->id)
        ->where('product_id', $id)
        ->first();

    if (!$cartItem) {
        return response()->json([
            "status" => "404",
            "message" => "هذا العنصر غير موجود في السلة.",
        ]);
    }
    // remove product
    $cartItem->delete();

    return response()->json([
        "status" => "200",
        "message" => "تم حذف العنصر من السلة بنجاح.",
    ]);
});
