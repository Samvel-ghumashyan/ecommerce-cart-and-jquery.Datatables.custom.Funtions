<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Orders::select('orders.id', 'orders.orders','orders.customer_date', 'orders.customer_phone','orders.email', 'orders.address_latitude', 'orders.address_longitude', 'orders.count', 'orders.cost', 'orders.created_at', 'orders.updated_at')->get();


        if($orders) {
            return response()->json([
                'message' => "Data Found",
                "code"    => 200,
                "data"  => $orders
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error_Index",
                "code"    => 500
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Orders();
        $location = $request->get('location', app('geoip.location'));

        $latitude = $location->latitude;
        $longitude = $location->longitude;

        $order->orders = $request->new_order;
        $order->customer_date = $request->new_date;
        $order->customer_phone = $request->new_phone;
        $order->email = $request->new_email;
        $order->address_latitude = $latitude;
        $order->address_longitude = $longitude;
        $order->count = $request->new_count;
        $order->cost = $request->new_cost;

        $result = $order->save();

        if($result) {
            return response()->json([
                'message' => "Data Inserted Successfully",
                "code"    => 200
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error_store",
                "code"    => 500
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $result = Orders::where('id', $request->id)->first();


        if($result) {
            return response()->json([
                'message' => "Data Found",
                "code"    => 200,
                "data"    => $result
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error_edit",
                "code"    => 500
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $result = Orders::where('id', $request->id)->update([
            'customer_date'      => $request->edit_date,
            'customer_phone'     => $request->edit_phone,
        ]);


        if($result) {
            return response()->json([
                'message' => "Data Updated Successfully!",
                "code"    => 200,
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error_update",
                "code"    => 500
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result = Orders::where('id', $request->id)->delete();

        if($result) {
            return response()->json([
                'message' => "Data Deleted Successfully!",
                "code"    => 200,
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error_destroy",
                "code"    => 500
            ]);
        }
    }
}
