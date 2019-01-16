<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Helpers;
use App\ShoppingCart;
use Session;

class ShoppingCartController extends Controller
{

   /*
    * Test index
    */
    public function index () {
        $totalPrice = ShoppingCart::totalPrice();
        $items = ShoppingCart::getCartItems();
        return view('shoppingcart', ['cart' => $items, 'total' => $totalPrice]);
    }

    /*
     * Add item to cart
     */
    public function addItem(Request $request) {
        $data = $request->validate([
           'item_id' => 'required|integer'
        ]);

        ShoppingCart::addItem($data['item_id']);
        return Redirect::to('/cart');
    }

    /**
     * Set quantity of cart item
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setQuantity(Request $request) {
        $data = $request->validate([
           'item_id' => 'required|integer',
           'quantity' => 'required|integer'
        ]);

        ShoppingCart::setQuantity($data);
        return Redirect::to('/cart');
    }

    /**
     * Remove item from shoppingcart
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeItem(Request $request) {
        $data = $request->validate([
            'item_id' => 'required|integer'
        ]);

        ShoppingCart::removeItem($data['item_id']);
        return Redirect::to('/cart');
    }


    /**
     * Empty shoppingcart
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearCart() {
        ShoppingCart::emptyCart();
        return Redirect::to('/cart');
    }
}
