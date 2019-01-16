<?php

namespace App;

use Session;
use App\Http\Helpers;

/**
 * Class ShoppingCart
 * @package App\Http
 */
class ShoppingCart
{
    public $cart;

    public function __construct()
    {
        $cart = Session()->get('cart');
    }

    /**
     * Check if cart is set
     *
     * @return bool
     */
    public static function checkForCart() {
        if(Session::get('cart')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Empty shoppingcart
     *
     * @return bool
     */
    public static function emptyCart() {
        if(session()->forget('cart')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Return total price of all items in shoppingcart
     *
     * @return bool|int
     */
    public static function totalPrice() {
        if(Self::checkForCart()) {
            $total = 0;
            $items = Self::getCartItems();

            if($items) {
                foreach ($items as $item) {
                    $total += $item->get_total_price();
                }
                return $total;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Get all items from shoppingcart
     *
     * @return bool|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public static function getCartItems() {
        if(Self::checkForCart()) {
            return session('cart');
        } else {
            return false;
        }
    }

    /**
     * Remove item from shoppingcarat
     *
     * @param $id
     * @return bool
     */
    public static function removeItem($id) {
        $cart = Self::getCartItems();
        foreach($cart as $cart_item) {
            if($cart_item->get_item_id() == $id) {
                unset($cart[array_search($cart_item, $cart)]);
                Self::saveCart($cart);
                return true;
            }
        }
    }

    /**
     * Save changes to shoppingcart
     *
     * @param $cart
     * @return bool
     */
    public static function saveCart($cart) {
        if(Session::put('cart', $cart)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Set quantity of shoppingcart item
     *
     * @param $data
     * @return bool
     */
    public static function setQuantity($data) {
        $item_id = $data['item_id'];
        $quantity = $data['quantity'];
        $cart = Self::getCartItems();
        $item = new Helpers\ShoppingCartItem($item_id);

        $cart = Session::get('cart');

        foreach($cart as $cart_item) {
            if($cart_item->get_item_id() == $item_id) {
                if($quantity <= 0) {
                    Self::removeItem($item_id);
                    return true;
                } else {
                    $cart_item->set_quantity($quantity);
                    return true;
                }
            }
        }

    }

    /**
     * Add item to shoppingcart
     *
     * @param $item_id
     * @return bool
     */
    public static function addItem($item_id) {
        $item = new Helpers\ShoppingCartItem($item_id);
        $cart = Self::getCartItems();
        //Check if cart is empty
        if(empty($cart)) {
            $cart[0] = $item;
        } else {
            //Check if item already exists in cart
            foreach ($cart as $cart_item) {
                if($cart_item->get_item_id() == $item->get_item_id()) {
                    $cart_item->set_quantity($cart_item->get_quantity() + 1);
                    return true;
                }
            }
            array_push($cart, $item);
        }
        return Self::saveCart($cart);
    }
}
