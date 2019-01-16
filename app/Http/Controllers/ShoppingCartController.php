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
    public function index (Request $request) {
        $cart = new ShoppingCart($request);
        return view('shoppingcart', ['cart' => $cart->items, 'total' => $cart->totalPrice]);
    }

    /**
     * Add item to cart
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addItem(Request $request) {
        $data = $request->validate([
           'item_id' => 'required|integer'
        ]);

        $cart = new ShoppingCart($request);

        $cart->addItem($data['item_id']);
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

        $cart = new ShoppingCart($request);

        $cart->removeItem($data['item_id']);
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

        $cart = new ShoppingCart($request);

        $cart->setQuantity($data);
        return Redirect::to('/cart');
    }

        /**
     * Empty shoppingcart
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearCart(Request $request) {
        $cart = new ShoppingCart($request);
        $cart->emptyCart();
        return Redirect::to('/cart');
    }
}
