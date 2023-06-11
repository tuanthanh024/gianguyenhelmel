@extends('backend.layout.app')
@section('title', 'Dashboard')

@section('css')
    <style>
        .item {
            color: white;
        }

        .item p {
            text-transform: capitalize;
        }

        .item>span {
            font-size: 35px !important;
        }

        .item h2 {
            font-weight: 600 !important;
        }

        .latest-order h5 {
            margin: 0;
            color: #1e88e5;
        }

        .latest-order>* {
            text-transform: capitalize;
        }

        .badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: .75em !important;
            font-weight: 500 !important;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }

        td img {
            max-width: 40px;
            width: 40px;
            border-radius: 50%;
        }

        .users td {
            padding: 10px 5px;
            border: none;
        }

        .users h5 {
            font-weight: 600 !important;
            margin: 0;
            text-transform: capitalize;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-sm-3">
                <div class="card bg-danger">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="item">
                                <h2>{{ number_format($totalRevenue, 0, '.', '.') }}đ</h2>
                                <p>total revenue</p>
                            </div>
                            <div class="item">
                                <span class="mdi mdi-cash-usd"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="item">
                                <h2>{{ $totalSales }}</h2>
                                <p>total sales</p>
                            </div>
                            <div class="item">
                                <span class="mdi mdi-gift"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="item">
                                <h2>{{ number_format($todayRevenue, 0, '.', '.') }}đ</h2>
                                <p>today revenue</p>
                            </div>
                            <div class="item">
                                <span class="mdi mdi-cash-usd"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="item">
                                <h2>{{ $todaySales }}</h2>
                                <p>today revenue</p>
                            </div>
                            <div class="item">
                                <span class="mdi mdi-gift"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card" style="min-height: 430px">
                    <div class="card-body"><canvas id="myChart1"></canvas></div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card" style="min-height: 430px">
                    <div class="card-body"><canvas id="myChart2"></canvas></div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center latest-order">
                            <h5>Latest Order</h5>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-xs rounded-3 btn-success cl-fff">view
                                all</a>
                        </div>
                        <div class="table-responsive px-2 mt-4">
                            <table class="text-center table align-middle mb-5 table-hover" id="data-table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-start">Customer name</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Order date</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($latestOrders as $key => $item)
                                        <tr>
                                            <td class="text-start">{{ $item->fullname }}</td>
                                            <td>{{ number_format($item->total_price, 0, '.', '.') }}đ</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i:s') }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-<?php
                                                    if ($item->orderStatus->id == 1) {
                                                        echo 'warning';
                                                    } elseif ($item->orderStatus->id == 2) {
                                                        echo 'primary';
                                                    } elseif ($item->orderStatus->id == 3) {
                                                        echo 'success';
                                                    } else {
                                                        echo 'danger';
                                                    }
                                                    ?>
                                    ">{{ $item->orderStatus->name }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center latest-order">
                            <h5>recent customers</h5>
                        </div>
                        <div class="table-responsive px-2 mt-4">
                            <table class="text-center table align-middle mb-5 table-hover users" id="data-table">
                                <tbody>
                                    @foreach ($users as $key => $item)
                                        <tr>
                                            <td style="width: 50px;height: 50px;"><img
                                                    src="{{ asset('storage/users/' . $item->avatar) }}" alt=""></td>
                                            <td class="text-start">
                                                <h5>{{ $item->name }}</h5>
                                                <p style="margin: 0;">{{ $item->email }}</p>
                                            </td>
                                        </tr>
                                    @endforeach

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script>
        $(document).ready(function() {
            const ctx1 = document.getElementById('myChart1');

            $.ajax({
                type: "POST",
                url: "/admin/dashboard/get-chart-data",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: "json",
                success: function(response) {
                    let labels = []
                    let data = []
                    for (var i = 0; i < response.orderStatus.length; i++) {
                        labels.push(response.orderStatus[i].name);
                        data.push(response.orderStatus[i].total_order);
                    }
                    new Chart(ctx1, {
                        type: 'doughnut',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: '',
                                data: data,
                                borderWidth: 1,
                                backgroundColor: [
                                    'rgb(255 178 43)',
                                    'rgb(13 110 253)',
                                    'rgb(25 135 84)',
                                    'rgb(252 75 108)',
                                ],
                                borderColor: [
                                    'rgb(255 178 43)',
                                    'rgb(13 110 253)',
                                    'rgb(25 135 84)',
                                    'rgb(252 75 108)',
                                ],
                            }]
                        },
                        options: {}
                    });
                }
            });
        });
    </script>
    <script>
        const ctx2 = document.getElementById('myChart2');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                datasets: [{
                    label: '# of Votes',
                    data: [7, 2, 10, 30, 17, 9, 15],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255, 99, 132,0.2)',
                        'rgba(255, 159, 64,0.2)',
                        'rgba(255, 205, 86,0.2)',
                        'rgba(75, 192, 192,0.2)',
                        'rgba(54, 162, 235,0.2)',
                        'rgba(153, 102, 255,0.2)',
                        'rgba(201, 203, 207,0.2)',
                        'rgba(105, 203, 207,0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)',
                        'rgb(105, 203, 207)',
                    ],
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
