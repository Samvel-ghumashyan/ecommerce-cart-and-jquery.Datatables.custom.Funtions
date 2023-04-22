<?php

namespace App\Http\Controllers;

use App\Models\CartCount;
use App\Models\CartProduct;
use App\Models\Orders;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{


public function cartShow (){
// Log::info(session('cart'));

    return view('layouts.cartShow');
}




    public function add_to_cart(Request $request)
    {

        $id = $request->id;
        Log::info('product_id');
        Log::info($id);


       // $qty = $request->qty;

      //  $qty = abs($qty);

        $product = Post::find($id);



        // Retrieve existing cart data from session, or create an empty array
        $cart = session()->get('cart', []);



        if (!isset($cart[$product->id])) {
            // Update existing item in cart
           // $cart[$product->id]['qty'] = $qty;
            $cart[$product->id] = [
                'title' => $product->title,
                'slug' => $product->slug,
                'price' => $product->price,
                'qty' => 1,
                'img' => $product->thumbnail,
            ];
        }

        // Update cart quantities and total sum
        session()->put('cart', $cart);
        session()->put('qnty', session()->get('qnty', 0) + 1);
        session()->put('summ', session()->get('summ', 0) + (1 * $product->price));

        // Save the session data
        session()->save();

        Log::info(session('CARTTTTTTTTTTTTTTTTTTTTTTTTTTTT'));
        Log::info(session('cart'));

        return response()->json(['id' => $id]);
    }








    public function delete_item(Request $request)
    {

        $id = $request->id;
        Log::info('cart_IDDDD');
        Log::info(session('cart')[$id]);


        if (isset(session('cart')[$id])) {
            Log::info("isset_if");

            Log::info("cart_id_qty");
            Log::info(session('cart')[$id]['qty']);

            $qty_minus = session('cart')[$id]['qty'];
            $sum_minus = session('cart')[$id]['qty'] * session('cart')[$id]['price'];



            $cartQty = session('qnty', 0);
            $cartQty -= $qty_minus;
            session(['qnty' => $cartQty]);

            Log::info("cart_qty");
            Log::info(session('qnty'));

            $cartSum = session('summ', 0);
            $cartSum -= $sum_minus;
            session(['summ' => $cartSum]);

            Log::info("cart_sum");
            Log::info(session('summ'));


            Session::forget('cart.' . $id);

            Log::info('VERJNAKAN RESULTATNERY cart qnty summ');
            Log::info(session('cart'));
            Log::info(session('qnty'));
            Log::info(session('summ'));

        }
        Log::info("if ENd");


       // $request->session()->flush();
        return view('layouts.cartShow');

    }




    public function clearAction()
    {
        if (empty(session('cart'))) {
            return false;
        }

        Session::forget('cart');
        Session::forget('qnty');
        Session::forget('summ');

        return view('layouts.cartShow');
    }

    public function buyProds(Request $request)
    {
        $location = $request->get('location', app('geoip.location'));

        $latitude = $location->latitude;
        $longitude = $location->longitude;


        $titleDatas = $request->tableTitle;
        $datas = $request->tableData;
        $otherDatas = $request->otherData;


        $productNames = [];
        foreach ($titleDatas as $key => $data) {
              $productNames[] = ($key + 1) . '- ' . implode(', ', $data);
        }

        $productNamesString = implode(', ', $productNames);


        $currentDateTime = now();

        $order = new Orders;
        $order->orders = $productNamesString;
        $order->customer_date = $currentDateTime;
        $order->customer_phone = $otherDatas[0][0];
        $order->email = $otherDatas[0][1];
        $order->address_latitude = $latitude;
        $order->address_longitude = $longitude;
        $order->count = $datas[0][0];
        $order->cost = $datas[1][0];


          $order->save();


        if (empty(session('cart'))) {
            return false;
        }

        Session::forget('cart');
        Session::forget('qnty');
        Session::forget('summ');

        return response()->json(['message' => 'Products order saved successfully']);

    }


}
