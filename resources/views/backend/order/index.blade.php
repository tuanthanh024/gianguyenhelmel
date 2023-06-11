@extends('backend.layout.app')
@section('title', 'Orders')

@section('css')
    <style>
        a.disabled {
            cursor: not-allowed !important;
            pointer-events: all !important;
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
    </style>
@endsection

@section('content')
    @include('backend.blocks.breadcrumb', [
        'page_title' => 'orders',
        'current_page' => 'all orders',
    ])
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center mb-3">
                            <form action="{{ route('admin.filter_orders_by_status') }}"
                                class="d-flex justify-content-start align-items-center gap-3">
                                <select class="form-select form-select-sm" name="status">
                                    <option value="0" selected>All orders</option>
                                    @foreach ($statuses as $item)
                                        <option value="{{ $item->id }}"
                                            @php
if (isset($status)) {
                                            if ($status == $item->id) {
                                                echo 'selected';
                                            }
                                        } @endphp>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </form>





                            <div class="btn-group" style="margin-left: auto">
                                <button type="button" class="btn btn-info cl-fff dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Export To
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"
                                            href="{{ route('export_order', ['format' => 'xlsx', 'status' => request()->status]) }}">Excel</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('export_order', ['format' => 'csv', 'status' => request()->status]) }}">Csv</a>
                                    </li>
                                </ul>
                            </div>


                            {{-- <form action="" class="mx-4 d-flex justify-content-start align-items-center gap-3">
                                <select class="form-select form-select-sm" name="sort_by" id="sort-by">
                                    <option value="total_price_asc">Total price (Low to High)</option>
                                    <option value="total_price_desc">Total price (High to Low)</option>
                                    <option value="created_at_desc">Newest</option>
                                    <option value="created_at_asc">Oldest</option>
                                </select>
                            </form>
                            <form style="margin-left: auto" action=""
                                class="d-flex justify-content-start align-items-center gap-3">
                                <select class="form-select form-select-sm" name="sort_by" id="sort-by">
                                    <option value="total_price_asc">Total price (Low to High)</option>
                                    <option value="total_price_desc">Total price (High to Low)</option>
                                    <option value="created_at_desc">Newest</option>
                                    <option value="created_at_asc">Oldest</option>
                                </select>
                            </form> --}}
                            {{-- <a href="{{ route('admin.products.create') }}" class="btn btn-success cl-fff">Add Product</a> --}}
                        </div>
                        <div class="table-responsive px-2">
                            <table class="text-center table align-middle mb-5 table-hover" id="data-table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-start">#</th>
                                        <th scope="col" class="text-start">Customer name</th>
                                        <th scope="col" class="text-start">Email</th>
                                        <th scope="col" class="text-start">Phone</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Order date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $key => $item)
                                        <tr>
                                            <td class="text-start">{{ $item->order_code }}</td>
                                            <td class="text-start">{{ $item->fullname }}</td>
                                            <td class="text-start">{{ $item->email }}</td>
                                            <td class="text-start">{{ $item->phone }}</td>
                                            <td>{{ number_format($item->total_price, 0, '.', '.') }}đ</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i:s') }}</td>
                                            <td class="order-status"><span
                                                    class="badge @if ($item->order_status_id == 1) {{ 'bg-warning' }}
                                                        @elseif ($item->order_status_id == 2)
                                                        {{ 'bg-primary' }}
                                                        @elseif ($item->order_status_id == 3)
                                                        {{ 'bg-success' }}
                                                    @else
                                                        {{ 'bg-danger' }} @endif">{{ $item->orderStatus->name }}
                                                </span>
                                            </td>
                                            <td>
                                                <div>
                                                    <a class="btn btn-success btn-xs"
                                                        href="{{ route('admin.products.edit', $item->id) }}"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a style="color: white" class="btn btn-info btn-xs"
                                                        href="{{ route('admin.orders.show', $item->id) }}"><i
                                                            class="fas fa-info-circle"></i></a>
                                                    <button data-url='{{ route('admin.delete_product') }}'
                                                        data-id="{{ $item->id }}" class="btn btn-danger btn-xs delete"
                                                        type="button"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button
                                                        {{ $item->order_status_id == 3 || $item->order_status_id == 4 ? 'disabled' : '' }}
                                                        style="border-radius: 4px;color: white"
                                                        class="btn btn-info btn-xs dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Status
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item {{ $item->order_status_id == 3 || $item->order_status_id == 4 ? 'disabled' : '' }}"
                                                                data-url="{{ route('admin.update_order_status') }}"
                                                                data-id="{{ $item->id }}" data-status="3"
                                                                href="#">Hoàn thành</a></li>
                                                        <li><a class="dropdown-item {{ $item->order_status_id == 3 || $item->order_status_id == 4 ? 'disabled' : '' }}"
                                                                data-url="{{ route('admin.update_order_status') }}"
                                                                data-id="{{ $item->id }}" data-status="4"
                                                                href="#">Hủy bỏ</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9">There are currently no orders in the system.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $orders->appends(['status' => $status ?? ''])->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('backend/js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('backend/js/popup-delete.js') }}"></script>
    <script>
        $(function() {
            $('.dropdown-item:not(.disabled)').on('click', function(e) {
                var self = $(this)

                $.ajax({
                    type: "POST",
                    url: self.data('url'),
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: self.data('id'),
                        status: self.data('status'),
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            if (response.status_code == 3) {
                                self.closest('tr').find('.order-status .badge').text(response
                                        .status_name).addClass('bg-success')
                                    .removeClass('bg-primary')
                            } else {
                                self.closest('tr').find('.order-status .badge').text(response
                                        .status_name).addClass('bg-danger')
                                    .removeClass('bg-primary')
                            }
                            self.closest('.dropdown-menu').find('.dropdown-item').addClass(
                                'disabled');
                            self.closest('.dropdown-menu').prevAll('button').first().addClass(
                                'disabled');

                        }
                    }
                });
            })

            $('select[name="status"]').change(function(e) {
                $(this).closest('form').submit()
            });
        })
    </script>
@endsection
