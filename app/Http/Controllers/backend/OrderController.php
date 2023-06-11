<?php

namespace App\Http\Controllers\backend;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        $statuses = OrderStatus::all();
        return view('backend.order.index', compact('orders', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('backend.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateOrderStatus(Request $request)
    {
        $order = Order::find($request->id);
        $order->order_status_id = $request->status;
        $order->update();

        if ($order->order_status_id == 4) {
            foreach ($order->products as $product) {
                $product->increment('quantity', $product->pivot->order_detail_quantity);
            }
        }

        return response()->json(['status' => true, 'status_name' => $order->orderStatus->name, 'status_code' => $order->order_status_id]);
    }

    public function filterOrder(Request $request)
    {
        $status = $request->status;
        if ($status == 0) {
            $orders = Order::latest()->paginate(10);
        } else {
            $orders = Order::where('order_status_id', $status)->latest()->paginate(10);
        }
        $statuses = OrderStatus::all();
        return view('backend.order.index', compact('orders', 'statuses', 'status'));
    }

    public function export(Request $request)
    {
        $format = $request->format;
        $status = $request->status;
        if ($format == 'xlsx') {
            return Excel::download(new OrdersExport($status), 'orders.xlsx');
        }
        return Excel::download(new OrdersExport($status), 'orders.csv');
    }
}
