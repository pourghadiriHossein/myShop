<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TCController extends Controller
{
    public function publicTC()
    {
        return view('public.termAndConditions.TCIndex');
    }
}
