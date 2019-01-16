<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProduct($id) {
        $product = \App\Product::where('id', $id)->firstOrFail();
        return view('product', ['product' => $product]);
    }
}
