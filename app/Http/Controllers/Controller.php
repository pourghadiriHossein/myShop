<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function session(Request $request,$ID,$quantity,$sessionTask)
    {
        switch ($sessionTask)
        {
            case 'add':
                if ($request->input('quantity'))
                    Tool::addProduct($ID,$request->input('quantity'));
                else
                    Tool::addProduct($ID,$quantity);
                break;
            case 'remove':
                Tool::remove($ID);
                break;
            case 'clean':
                Tool::clean();
                break;
            case 'addTokenDiscount':
                Tool::addTokenDiscount($request->input('token'));
                break;
            case 'cleanTokenDiscount':
                Tool::cleanTokenDiscount();
                break;
            case 'getTokenDiscount':
                Tool::getTokenDiscount();
                break;
        }
        return redirect(url()->previous());
    }
}
