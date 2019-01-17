<?php

namespace App;

use Session;
use App\Http\Helpers;
use Illuminate\Http\Request;

/**
 * Class ShoppingCart
 * @package App\Http
 */
class ShoppingCart{

    public $items;
    public $totalPrice;
    public $request;

    public function __construct(Request $request) {
        $this->items = $request->session()->get('cart');
        $this->totalPrice = $this->totalPrice();
        $this->request = $request;
    }

    /**
     * Add item to shoppingcart
     *
     * @param $item_id
     * @return bool
     */
    public function addItem($item_id) {
        $item = new Helpers\ShoppingCartItem($item_id);

        if(!empty($this->items)) {
            foreach($this->items as $cart_item) {
                if($cart_item->get_item_id() == $item->get_item_id()) {//Item already in cart
                    $cart_item->set_quantity($cart_item->get_quantity() + 1);
                    return true;
                }
            }
            array_push($this->items, $item);
        } else {
            $this->items[0] = $item;
        }

        return $this->saveCart();
    }

    /**
     * Remove item from shoppingcarat
     *
     * @param $id
     * @return bool
     */
    public function removeItem($id) {
        foreach($this->items as $cart_item) {
            if($cart_item->get_item_id() == $id) {
                unset($this->items[array_search($cart_item, $this->items)]);
                return $this->saveCart();
            }
        }
    }

    /**
     * Return total price of all items in shoppingcart
     *
     * @return bool|int
     */
    public function totalPrice() {
        $total = 0;
        if($this->items) {
            foreach($this->items as $item) {
                $total += $item->get_total_price();
            }
            return $total;
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
    public function setQuantity($data) {
        $item_id = $data['item_id'];
        $quantity = $data['quantity'];
        $item = new Helpers\ShoppingCartItem($item_id);

        foreach($this->items as $cart_item) {
            if($cart_item->get_item_id() == $item->get_item_id()) {
                if($quantity <= 0) {
                    return $this->removeItem($item->get_item_id());
                } else {
                    $cart_item->set_quantity($quantity);
                    return true;
                }
            }
        }

    }

    /**
     * Empty shoppingcart
     *
     * @return bool
     */
    public function emptyCart() {
        $this->items = array();
        return $this->saveCart();
    }

    /**
     * Save changes to shoppingcart
     *
     * @param $cart
     * @return bool
     */
    public function saveCart() {
        if($this->request->session()->put('cart', $this->items)) {
            return true;
        } else {
            return false;
        }
    }
}
