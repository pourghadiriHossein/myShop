<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartIndex()
    {
        return view('public.cart.cartIndex');
    }
}
