<?php

namespace App\Http\Controllers;

use App\Models\Delavery;
use App\Models\Sales;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

class Report_Controller extends Controller
{
    public function deliveryReportAll()
    {
        $data = DB::select("
        SELECT
        delivery_reports.status,delivery_reports.created_at,users.name,users.Location,delaveries.name as deliver_name
        FROM delivery_reports

        INNER JOIN users ON delivery_reports.Clinic_Id = users.id
        INNER JOIN delaveries ON delivery_reports.Delivery_Id = delaveries.id

        WHERE delaveries.Manger_Id = ?
        ", [Auth()->user()->id]);

        $fail = DB::select("
        SELECT
        delivery_reports.status

        FROM delivery_reports

        INNER JOIN users ON delivery_reports.Clinic_Id = users.id
        INNER JOIN delaveries ON delivery_reports.Delivery_Id =delaveries.id

        WHERE delaveries.Manger_Id = ?
        And delivery_reports.status = 'failure'
        ", [Auth()->user()->id]);


        $Success = DB::select("
        SELECT
        delivery_reports.status

        FROM delivery_reports

        INNER JOIN users ON delivery_reports.Clinic_Id = users.id
        INNER JOIN delaveries ON delivery_reports.Delivery_Id =delaveries.id

        WHERE delaveries.Manger_Id = ?
        And delivery_reports.status = 'Success'
        ", [Auth()->user()->id]);

        $delivery = Delavery::where("Manger_Id", Auth()->user()->id)->get();

        return view(
            "Dashboard/ProviderAdmin/Report/DeliveryReport",
            [
                "data" => $data,
                "delivery" => $delivery,
                "fail" => Count($fail),
                "Success" => Count($Success),
            ]
        );
    }

    public function deliveryReportByOneDelivery(Request $request)
    {
        $data = DB::select("
        SELECT
        delivery_reports.status,delivery_reports.created_at,users.name,users.Location,delaveries.name as deliver_name
        FROM delivery_reports

        INNER JOIN users ON delivery_reports.Clinic_Id = users.id
        INNER JOIN delaveries ON delivery_reports.Delivery_Id =delaveries.id

        WHERE delaveries.Manger_Id = ? And delaveries.id =?
        ", [Auth()->user()->id, $request->id_delivery]);

        $fail = DB::select("
        SELECT
        delivery_reports.status

        FROM delivery_reports

        INNER JOIN users ON delivery_reports.Clinic_Id = users.id
        INNER JOIN delaveries ON delivery_reports.Delivery_Id =delaveries.id

        WHERE delaveries.Manger_Id = ?
        And delivery_reports.status = 'failure' And delaveries.id =?
        ", [Auth()->user()->id, $request->id_delivery]);


        $Success = DB::select("
        SELECT
        delivery_reports.status

        FROM delivery_reports

        INNER JOIN users ON delivery_reports.Clinic_Id = users.id
        INNER JOIN delaveries ON delivery_reports.Delivery_Id =delaveries.id

        WHERE delaveries.Manger_Id = ?
        And delivery_reports.status = 'Success' And delaveries.id =?
        ", [Auth()->user()->id, $request->id_delivery]);

        $delivery = Delavery::where("Manger_Id", Auth()->user()->id)->get();

        return view(
            "Dashboard/ProviderAdmin/Report/DeliveryReport",
            [
                "data" => $data,
                "delivery" => $delivery,
                "fail" => Count($fail),
                "Success" => Count($Success),
            ]
        );
    }
    public function PDFDelivery(Request $request)
    {
      
    }

    public function PurchasesReportAll()
    {
        $start_Time = Sales::first();
        $end_Time = Sales::orderByDesc("id")->first();
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

        $total_Balance = 0;
        for ($i = 0; $i < count($data); $i++) {
            $total_Balance += $data[$i]->Balance;
        }

        return view(
            "Dashboard/ProviderAdmin/Report/PurchasesReport",
            [
                "data" => $data,
                "total_Balance" => $total_Balance,
                "Start_time" => $start_Time->created_at->format('Y-m-d'),
                "End_time" => $end_Time->created_at->format('Y-m-d')
            ]
        );
    }
    public function PurchasesReportByTime(Request $request)
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
        And sales.created_at between ? and ?
         ORDER BY sales.id DESC
    ", [Auth()->user()->id, $request->Start_time, $request->End_time]);

        $total_Balance = 0;
        for ($i = 0; $i < count($data); $i++) {
            $total_Balance += $data[$i]->Balance;
        }

        return view(
            "Dashboard/ProviderAdmin/Report/PurchasesReport",
            [
                "data" => $data,
                "total_Balance" => $total_Balance,
                "Start_time" => $request->Start_time,
                "End_time" => $request->End_time
            ]
        );
    }
    public function PDFPurchases(Request $request)
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
        And sales.created_at between ? and ?
         ORDER BY sales.id DESC
    ", [Auth()->user()->id, $request->Start_time, $request->End_time]);

        $total_Balance = 0;
        for ($i = 0; $i < count($data); $i++) {
            $total_Balance += $data[$i]->Balance;
        }
        $pdf = Pdf::loadView('Dashboard/ProviderAdmin/PDF/PdfPurchasesReport', [
            "data" => $data,
            "total_Balance" => $total_Balance,
            "Start_time" => $request->Start_time,
            "End_time" => $request->End_time
        ]);
        return $pdf->download('invoice.pdf');
    }
}
