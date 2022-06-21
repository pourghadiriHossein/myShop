<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use App\Models\Transaction;
use App\Models\Zone;
use App\Models\Address;
use App\Models\Tool;
use App\Models\Order;
use App\Models\OrderListItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutRequest;


class CheckoutController extends Controller
{
    public function checkoutIndex()
    {
        if (Auth::guest()) {
            return redirect(route('login'));
        }else{
            $regions = Region::all();
            $cities = City::all();
            $zones = Zone::all();
            $addresses = Auth::user()->addresses;
            return view('public.checkout.checkoutIndex',compact('regions','cities','zones','addresses'));
        }
    }
    public function postCheckout(CheckoutRequest $request)
    {
        if (!empty(Tool::getBasket())) {
            if ($request->input('newAddress')){
                $newAddress = new Address();
                $newAddress->user_id = Auth::user()->id;
                $newAddress->zone_id = $request->input('zoneID');
                $newAddress->detail = $request->input('detail');
                $newAddress->save();
                $currentAddressID = $newAddress->id;
            }else{

                $currentAddressID = $request->input('previousAddress');
            }
            $baskets = Tool::getBasket();
            $discounts = Tool::getTokenDiscount();
            $totalDiscount = Tool::calculateDiscountSession();
            $total_price = Tool::calculateCart();

            $newOrder = new Order();
            $newOrder->user_id = Auth::user()->id;
            $newOrder->address_id = $currentAddressID;
            if (!$totalDiscount == 0) {
                foreach ($discounts as $discount)
                    $newOrder->discount_id = $discount->id;
            }
            $newOrder->total_price = $total_price;
            $newOrder->pay_price = $total_price - $totalDiscount;
            $newOrder->status = 1;
            $newOrder->save();

            foreach($baskets as $basket)
            {
                $newOrderListItem = new OrderListItem();

                $newOrderListItem->user_id = Auth::user()->id;
                $newOrderListItem->product_id = $basket[0]->id;
                $newOrderListItem->order_id = $newOrder->id;
                $newOrderListItem->price = $basket[0]->price;
                $newOrderListItem->status = 1;
                $newOrderListItem->save();
            }
            $newTransaction = new Transaction();
            $newTransaction->order_id = $newOrder->id;
            $newTransaction->price = $newOrder->pay_price;
            $newTransaction->resnum = Carbon::now();
            $newTransaction->refnum = null;
            $newTransaction->status = 0;
            $newTransaction->message = 'در انتظار پرداخت';
            $newTransaction->save();
            Tool::clean();
            Tool::cleanTokenDiscount();
            return redirect(route('adminVisitTransaction'));
        }else
            return redirect(route('publicHome'));
    }

    public function sendForPay($transactionID)
    {
        $transaction = Transaction::find($transactionID);
        dd($transaction);
    }
}
