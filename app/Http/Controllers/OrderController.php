<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index() {
        $orders = \App\Order::where('user_id', "=", Auth::user()->id)->get();
        return view('orders', ['orders' => $orders]);
    }

    public function show_order($order_id) {
        if(!is_numeric($order_id)) {
            abort(404);
        }

        $order = \App\Order::where('id', '=', $order_id)->first();

        if($order->user_id != Auth::user()->id) {
            abort(404);
        } else {
            return view('order', ['order_products' => $order->products()]);
        }

    }



}
