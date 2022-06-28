<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ContactAction;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function publicContact()
    {
        return view('public.contact.contactIndex');
    }

    public function postContact(ContactRequest $request)
    {
        ContactAction::addContact($request);
        return redirect()->back()->with('success' ,'پیام شما ارسال شد؛ در کوتاه ترین زمان ممکن با شما تماس گرفته می شود');
    }
}
