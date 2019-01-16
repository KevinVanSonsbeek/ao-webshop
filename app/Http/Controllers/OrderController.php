<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;

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

    public function showOrder($order_id) {
        if(!is_numeric($order_id)) {
            abort(404);
        }

        $order = \App\Order::where('id', '=', $order_id)->first();
        $items = \App\OrderDetail::where('order_id', '=', $order_id)->get();

        if($order->user_id != Auth::user()->id) {
            abort(404);
        } else {
            return view('order', ['order_products' =>$items]);
        }

    }

    public function add() {
        //Get cart
        $cart = Session('cart');

        //Get user id
        $user_id = Auth::user()->id;

        $order_id = \App\Order::insertGetId(
            ['user_id' => $user_id]
        );

        foreach ($cart as $product) {
            \App\OrderDetail::insert(
                ['order_id' => $order_id, 'product_id' => $product->get_item_id(), 'quantity' => $product->get_quantity()]
            );
        }

        session()->forget('cart');

        return Self::index();

    }



}
