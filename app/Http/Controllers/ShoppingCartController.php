<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Helpers;
use Session;

class ShoppingCartController extends Controller
{

   /*
    * Test index
    */
    public function index () {
        return view('shoppingcart', ['cart' => Session::get('cart'), 'total' => Self::total_price()]);
    }

    /**
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed|string
     */
    public function get_cart_items() {
        if(session()->has('cart')) {
            return session('cart');
        } else {
            return "Empty";
        }
    }

    /*
     * Add item to cart
     */
    public function add_item() {
        $item_id = $_POST['item_id'];
        $item = new Helpers\ShoppingCartItem($item_id);

        //Check if cart already exists
        if(Session::get('cart')) {
            $cart = Session::get('cart');
        } else {
            $cart = [];
        }

        //Check if cart is empty
        if(empty($cart)) {
            $cart[0] = $item;
        } else {

            //Check if item already exists in cart
            foreach ($cart as $cart_item) {
                if($cart_item->get_item_id() == $item->get_item_id()) {
                    $cart_item->set_quantity($cart_item->get_quantity() + 1);
                    return Redirect::to('/cart');
                }
            }

            array_push($cart, $item);


        }

        Session::put('cart', $cart);
        return Redirect::to('/cart');
    }

    /**
     * @param $item_id
     * @param $quantity
     */
    public function set_quantity() {
        $quantity = $_POST['quantity'];
        $item_id = $_POST['item_id'];
        if(is_nan($quantity) || is_nan($item_id))
            return;

        $item = new Helpers\ShoppingCartItem($item_id);

        if(!Session::get('cart')) {
            return;
        } else {
            $cart = Session::get('cart');

            foreach($cart as $cart_item) {
                if($cart_item->get_item_id() == $item->get_item_id()) {
                    if($quantity <= 0) {
                        Self::remove_item($item->get_item_id());
                        return Redirect::to('/cart');
                        //return array("status" => 200, "message" => "Item removed from shoppingcart!");
                    } else {
                        $cart_item->set_quantity($quantity);
                        return Redirect::to('/cart');
                        //return array("status" => 200, "message" => "Updated amount!");
                    }
                }
            }
        }
    }

    /**
     * Get total price of the shoppingcart
     */
    public function total_price() {
        if (!Session::get('cart'))
            return;

        $total = 0;
        foreach (Session::get('cart') as $item) {
            $total += $item->get_total_price();
        }
        return $total;
    }

    /**
     * @param $item_id
     */
    public function remove_item($item_id = null) {
        if($item_id == null)
            $item_id = $_POST['item_id'];

        $item = new Helpers\ShoppingCartItem($item_id);
        if(is_nan($item_id))
            return;

        if(!Session::get('cart')) {
            return;
        } else {
            $cart = Session::get('cart');

            foreach($cart as $cart_item) {
                if($cart_item->get_item_id() == $item->get_item_id()) {
                    unset($cart[array_search($cart_item, $cart)]);
                    Session::put('cart', $cart);
                }
            }
        }
        return Redirect::to('/cart');
    }

    /**
     *
     */
    public function clear_cart() {
        session()->forget('cart');
        return Redirect::to('/cart');
    }
}
