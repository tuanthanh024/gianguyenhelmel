<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $latestOrders = Order::latest('created_at')->take(10)->get();
        $userIds = Order::distinct('user_id')->pluck('user_id');
        $users = User::whereIn('id', $userIds)->where('role', 0)->take(10)->get();
        $totalSales = Order::where('order_status_id', 3)->count(); // tổng đơn hàng hoản thành
        $totalRevenue = Order::where('order_status_id', 3)->sum('total_price'); // tổng doanh thu
        $todaySales = Order::where('order_status_id', 3)->whereDate('created_at', Carbon::today())->count(); // tổng đơn hàng hoản thành trong ngày
        $todayRevenue = Order::where('order_status_id', 3)->whereDate('created_at', Carbon::today())->sum('total_price'); // tổng doanh thu trong ngày
        return view('backend.dashboard', compact(
            'latestOrders',
            'users',
            'totalSales',
            'totalRevenue',
            'todaySales',
            'todayRevenue'
        ));
    }

    public function getChartData(Request $request)
    {
        $orderStatus = OrderStatus::select('name', DB::raw('COUNT(*) as total_order'))
            ->join('orders', 'orders.order_status_id', '=', 'order_status.id')
            ->groupBy('order_status.name')
            ->get();
        return response()->json([
            'orderStatus' => $orderStatus
        ]);
    }
}
