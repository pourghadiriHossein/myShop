<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Gateway;
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
        $regions = Region::all();
        $cities = City::all();
        $zones = Zone::all();
        $addresses = Auth::user()->addresses;
        return view('public.checkout.checkoutIndex',compact('regions','cities','zones','addresses'));
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
            $newOrder->status = 0;
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
            $newTransaction->amount = $newOrder->pay_price;
            $newGateway = new Gateway();
            $result = $newGateway->start($newOrder->id,$newOrder->pay_price);
            if (isset($result->error_code))
            {
                $newTransaction->status = $result->error_code;
                $newTransaction->save();
                Tool::clean();
                Tool::cleanTokenDiscount();
                return redirect(route('adminVisitOrder'));
            }
            else{
                $newTransaction->IDPay_id = $result->id;
                $newTransaction->save();
                Tool::clean();
                Tool::cleanTokenDiscount();
                return redirect($result->link);
            }
        }else
            return redirect(route('publicHome'));
    }

    public function sendForPay($orderID)
    {
        $order = Order::find($orderID);
        $newGateway = new Gateway();
        $newTransaction = new Transaction();
        $newTransaction->order_id = $order->id;
        $newTransaction->amount = $order->pay_price;
        $result = $newGateway->start($order->id,$order->pay_price);
        if (isset($result->error_code))
        {
            $newTransaction->status = $result->error_code;
            $newTransaction->save();
            return redirect(route('adminVisitOrder'));
        }
        else{
            $newTransaction->IDPay_id = $result->id;
            $newTransaction->save();
            return redirect($result->link);
        }
    }

    public function callback(Request $request)
    {
        if (!$request->input('order_id'))
            return redirect(route('adminVisitOrder'));
        $IDPayID = $request->input('id');
        $orderID = $request->input('order_id');
        $transaction = Transaction::where([['order_id', $orderID],['IDPay_id',$IDPayID]])->first();
        $verify = new Gateway();
        $result = $verify->done($IDPayID, $orderID);
        if (isset($result->error_code))
        {
            $transaction->status = $result->error_code;
            $transaction->save();
            return redirect(route('adminVisitTransaction'));
        }
        else {
            $transaction->status = $result->status;
            $transaction->IDPay_track_id = $result->track_id;
            $transaction->card_no = $result->payment->card_no;
            $transaction->pay_date = $result->date;
            $transaction->verify_date = $result->verify->date;
            $transaction->save();
            $order = Order::find($request->input('order_id'));
            $order->status = 1;
            $order->save();
            return redirect(route('adminVisitTransaction'));
        }
    }
}
