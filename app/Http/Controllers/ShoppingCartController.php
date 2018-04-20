<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers;

class ShoppingCartController extends Controller
{

   /*
    * Test index
    */
    public function index () {
        if(!session()->has('cart')) {
            echo "Cart is empty";
        } else {
            print_r(session('cart'));
        }
    }

    /*
     * Get all items in cart
     */
    public function get_cart_items() {
        if(session()->has('cart')) {
            return session('cart');
        } else {
            return "Empty";
        }
    }

    /*
     * Set item quantity
     */
    public function set_item_quantity() {

    }

    /*
     * Add item to cart
     */
    public function add_item($item_id) {
        $item = new Helpers\ShoppingCartItem($item_id);
        //Check if entered item_id is valid
        if($item) {
            print_r($item);
        }

        $cart = self::get_cart_items();

        //Check if cart is empty
        if($cart == "Empty" || $cart = "") {
            //If emtpy create cart
            echo "Empty";
            session(['cart' => [$item]]);

        } else {
            $exists = false;
            //Check if item is already in cart
            foreach ($cart as $cart_item) {
                if($cart_item->get_item_id() == $item->get_item_id()) {
                    $exists = true;
                    break;
                }
            }

            if(!$exists) {
                echo "NOT EXISTING IN CART";
            } else {
                echo "ALREADY EXISTS";
            }



        }
    }

    /*
     * Remove item from cart
     */
    public function remove_item($item_id) {
        print_r($item_id);
    }

    /*
     * Clear cart
     */
    public function clear_cart() {
        session()->forget('cart');
        return;
    }
}
