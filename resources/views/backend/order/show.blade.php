@extends('backend.layout.app')
@section('title', 'Order details')

@section('css')
    <style>
        td[colspan='3'] {
            border-bottom: none;
        }
    </style>
@endsection

@section('content')
    @include('backend.blocks.breadcrumb', [
        'page_title' => 'order details',
        'current_page' => 'order details',
    ])
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            Ordered items
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-success cl-fff">All orders</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    @foreach ($order->products as $item)
                                        <tr>
                                            <td style="width: 90px;padding: 5px 0;"><img
                                                    src="{{ asset('storage/products/' . $item->featured_image) }}"
                                                    class="img-fluid" alt="..."></td>
                                            <td>{{ $item->name }}</td>
                                            <td class="text-center">
                                                {{ number_format($item->price - $item->discount, 0, '.', '.') }}đ</td>
                                            <td>x {{ $item->pivot->order_detail_quantity }}</td>
                                            <td class="text-end">
                                                {{ number_format(($item->price - $item->discount) * $item->pivot->order_detail_quantity, 0, '.', '.') }}đ
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="text-start">Subtotal</td>
                                        <td class="text-end fw-bold">{{ number_format($order->total_price, 0, '.', '.') }}đ
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="text-start">Shipping fee</td>
                                        <td class="text-end fw-bold">{{ number_format($order->shipping_fee, 0, '.', '.') }}đ
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="text-start">Total</td>
                                        <td class="text-end fw-bold">
                                            {{ number_format($order->total_price + $order->shipping_fee, 0, '.', '.') }}đ
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Billing details
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Fullname</th>
                                        <td>{{ $order->fullname }}</td>
                                        <th>Email</th>
                                        <td>{{ $order->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $order->phone }}</td>
                                        <th>Address</th>
                                        <td>{{ $order->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ward</th>
                                        <td>{{ $order->shipping_ward }}</td>
                                        <th>District</th>
                                        <td>{{ $order->shipping_district }}</td>
                                    </tr>
                                    <tr>
                                        <th>Province</th>
                                        <td>{{ $order->shipping_province }}</td>
                                        <th></th>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Transaction
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{ $order->orderStatus->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order date</th>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Payment methods</th>
                                        <td>Thanh toán khi nhận hàng</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- <script src="{{ asset('backend/js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('backend/js/popup-delete.js') }}"></script>
    <script>
        $(function() {
            $('.featured-product').on('click', function(e) {
                var self = $(this)
                $.ajax({
                    type: "POST",
                    url: self.data('url'),
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: self.data('id')
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            self.toggleClass('fa-circle')
                            self.toggleClass('fa-star')
                        }
                    }
                });
            })
        })
    </script> --}}
@endsection
