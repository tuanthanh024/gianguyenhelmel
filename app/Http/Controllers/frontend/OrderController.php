<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmationEmail;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orderLists = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('frontend.order', compact('orderLists'));
    }

    public function orderDetail($order_code)
    {
        $order = Order::where('order_code', $order_code)->first();
        $totalNotDiscount = 0;
        $totalDiscount = 0;
        $products = $order->products->reverse();
        foreach ($products as  $product) {
            $totalNotDiscount += $product->pivot->order_detail_quantity * $product->price;

            if ($product->discount != 0) {
                $totalDiscount += $product->pivot->order_detail_quantity * $product->discount;
            }
        }
        return view('frontend.order_detail', compact('order', 'products', 'totalNotDiscount', 'totalDiscount'));
    }

    public function confirmOrder(Request $request)
    {
        $order = Order::where('order_code', $request->order_code)
            ->where('confirmation_token', $request->token)
            ->first();

        if ($order) {
            if ($order->order_status_id == 1) {
                $expirationDate = Carbon::parse($order->expiration_date);
                $status = false;
                if ($expirationDate->isPast()) {
                    $order->confirmation_token = Str::random(50);
                    $order->expiration_date = Carbon::now()->addHours(24);
                } else {
                    $order->confirmation_token = null;
                    $order->expiration_date = null;
                    $order->order_status_id = 2;
                    $status = true;
                }
                $order->update();
                return view('frontend.confirm_order', compact('status', 'order'));
            }
        }
        return abort(404);
    }

    public function resendOrderConfirmationEmail(Request $request)
    {
        $order = Order::where('order_code', $request->order_code)->first();
        if ($order) {
            Mail::to($order->email)->queue(new OrderConfirmationEmail($order));
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }

    public function cancelOrder(Request $request)
    {
        $order = Order::where('order_code', $request->order_code)->first();
        $order->order_status_id = 4;
        $order->update();

        foreach ($order->products as $product) {
            $product->increment('quantity', $product->pivot->order_detail_quantity);
        }

        return response()->json(true);
    }
}
