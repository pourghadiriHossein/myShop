<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function publicFAQ()
    {
        return view('public.FAQ.FAQIndex');
    }
}
