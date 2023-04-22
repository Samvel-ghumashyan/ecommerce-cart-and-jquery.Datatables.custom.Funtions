<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;

class OrdersMainController extends Controller
{
    public function index (){
        $orders = Orders::get();

        return view('admin.orders.index', ['orders' => $orders]);
    }
}
