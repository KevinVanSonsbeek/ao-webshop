<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function display_product($id) {
        $product = \App\Product::where('id', $id)->firstOrFail();
        return view('product_display', ['product' => $product]);
    }
}
