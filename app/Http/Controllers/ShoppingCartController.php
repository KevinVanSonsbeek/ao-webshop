<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\ShoppingCart;

class ShoppingCartController extends Controller
{
    public $cart;

    public function __construct(Request $request) {
        $this->cart = new ShoppingCart($request);
    }

    /**
     * Show shoppingCart page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index (Request $request) {
        return view('shoppingcart', ['cart' => $this->cart->items, 'total' => $this->cart->totalPrice]);
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

        $this->cart->addItem($data['item_id']);
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

        $this->cart->removeItem($data['item_id']);
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

        $this->cart->setQuantity($data);
        return Redirect::to('/cart');
    }

        /**
     * Empty shoppingcart
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearCart(Request $request) {
        $this->cart->emptyCart();
        return Redirect::to('/cart');
    }
}
