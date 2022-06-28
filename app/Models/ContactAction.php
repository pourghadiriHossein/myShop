<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ContactAction
{
    public static function addContact($request)
    {
        $newContact = new Contact();
        if (Auth::user())
            $newContact->user_id = Auth::user()->id;
        $newContact->name = $request->input('name');
        $newContact->phone = $request->input('phone');
        $newContact->description = $request->input('description');
        $newContact->save();
        return back();
    }
}
