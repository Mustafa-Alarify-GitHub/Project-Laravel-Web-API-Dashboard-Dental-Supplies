<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Login User
Route::post("/Login", function (Request $request) {
    // Validation
    $validator = Validator::make($request->all(), [
        "email" => "required|email|min:4",
        "password" => "required|string|min:4",
    ], [
        "email.required" => "يرجى إدخال البريد الإلكتروني.",
        "email.email" => "يجب أن يكون البريد الإلكتروني صالحًا.",
        "email.min" => "يجب أن يحتوي البريد الإلكتروني على 4 أحرف على الأقل.",
        "password.required" => "يرجى إدخال كلمة المرور.",
        "password.string" => "يجب أن تكون كلمة المرور نصية.",
        "password.min" => "يجب أن تكون كلمة المرور على الأقل 4 أحرف.",
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json([
            "status" => "400",
            "message" => "هناك أخطاء في المدخلات",
            "errors" => $validator->errors()
        ], 400);
    }

    // Check if user exists
    $user = User::where("email", $request->email)->first();
    if (!$user) {
        return response()->json([
            "status" => "404",
            "message" => "هذا البريد الإلكتروني غير موجود",
        ]);
    }

    // Check if the password is correct
    if (!Hash::check($request->password, $user->password)) {
        return response()->json([
            "status" => "400",
            "message" => "البريد الإلكتروني أو كلمة المرور غير صحيحة",
        ]);
    }

    return response()->json([
        "status" => "200",
        "message" => "تم تسجيل الدخول بنجاح",
        "data" => $user
    ]);
});

// Register New User
Route::post("/Register", function (Request $request) {
  
    // Validation
    $validator = Validator::make($request->all(), [
        "email" => "required|email|min:4|unique:users,email",
        "password" => "required|string|min:4",
        "clinic" => "required|string|min:4|max:15",
        "name" => "required|string",
        "phone" => "required",
        "Location" => "required|string",
    ], [
        "email.required" => "يرجى إدخال البريد الإلكتروني.",
        "email.email" => "يجب أن يكون البريد الإلكتروني صالحًا.",
        "email.min" => "يجب أن يحتوي البريد الإلكتروني على 4 أحرف على الأقل.",
        "email.unique" => "هذا البريد الإلكتروني مسجل بالفعل.",
        "password.required" => "يرجى إدخال كلمة المرور.",
        "password.string" => "يجب أن تكون كلمة المرور نصية.",
        "password.min" => "يجب أن تكون كلمة المرور على الأقل 4 أحرف.",
        "clinic.required" => "يرجى إدخال اسم العيادة.",
        "clinic.string" => "يجب أن يكون اسم العيادة نصًا.",
        "clinic.min" => "يجب أن يكون اسم العيادة على الأقل 4 أحرف.",
        "clinic.max" => "يجب ألا يزيد اسم العيادة عن 15 حرفًا.",
        "name.required" => "يرجى إدخال الاسم.",
        "name.string" => "يجب أن يكون الاسم نصيًا.",
        "phone.required" => "يرجى إدخال رقم الهاتف.",
        "phone.string" => "يجب أن يكون رقم الهاتف نصيًا.",
        "Location.required" => "يرجى إدخال العنوان.",
        "Location.string" => "يجب أن يكون العنوان نصيًا.",
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return response()->json([
            "status" => "400",
            "errors" => $validator->errors()
        ], 400);
    }


    // Check Email is Already existing
    $user = User::where("email", $request->email)->first();
    if ($user) {
        return response()->json([
            "status" => "400",
            "message" => "هذا البريد الإلكتروني مسجل مسبقاً.",
        ]);
    }
  
    // Hash password
    $hashedPassword = Hash::make($request->password);

    // Create the user in the database
        $newUser = User::create([
            'email' =>" $request->email",
            'password' => $hashedPassword,
            'name_company' => $request->clinic,
            'name' => $request->name,
            'phone' => $request->phone,
            'Location' => $request->Location,
            'type' => "Clinic",
        ]);
 
   

    return response()->json([
        "status" => "200",
        "message" => "تم التسجيل بنجاح",
        "data" => $newUser
    ]);
});

