@extends('backend.layout.app')
@section('title', 'Products')

@section('content')
    @include('backend.blocks.breadcrumb', [
        'page_title' => 'products',
        'current_page' => 'all products',
    ])
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end align-items-center mb-3 gap-3">
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                            <a href="{{ route('admin.products.create') }}" class="btn btn-success cl-fff">Add Product</a>
                        </div>
                        <div class="table-responsive px-2">
                            <table class="text-center table align-middle mb-5 table-hover" id="data-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Featured</th>
                                        <th scope="col">Image</th>
                                        <th scope="col" style="max-width: 300px;width: 300px">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td class="text-center">
                                                <i data-url="{{ route('admin.set_featured_product') }}"
                                                    data-id="{{ $item->id }}"
                                                    class="featured-product fas {{ $item->featured == 1 ? 'fa-star' : 'fa-circle' }} fa-lg"></i>
                                            </td>
                                            <td style="width: 90px;padding: 5px 0;"><img
                                                    src="{{ asset('storage/products/' . $item->featured_image) }}"
                                                    class="img-fluid" alt="..."></td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ number_format($item->price, 0, '.', '.') }}đ</td>
                                            <td>{{ number_format($item->discount, 0, '.', '.') }}đ</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>
                                                <div
                                                    class="text-capitalize badge rounded-pill bg-{{ $item->status == 'active' ? 'success' : 'danger' }}">
                                                    {{ $item->status }}</div>
                                            </td>
                                            <td>
                                                <div>
                                                    <a class="btn btn-success btn-xs"
                                                        href="{{ route('admin.products.edit', $item->id) }}"><i
                                                            class="fas fa-edit"></i></a>
                                                    <button data-url='{{ route('admin.delete_product') }}'
                                                        data-id="{{ $item->id }}" class="btn btn-danger btn-xs delete"
                                                        type="button"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">You don't have any products yet, please click the add button
                                                to add a new product.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $products->links('pagination::bootstrap-4') }}
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
    </script>
@endsection
