@extends('backend.layout.app')
@section('title', 'Add Product')

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/css/select2.css') }}">
@endsection

@section('content')
    @include('backend.blocks.breadcrumb', [
        'page_title' => 'products',
        'current_page' => 'add products',
    ])
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form class="w-75" action="{{ route('admin.products.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" name="slug" value="" readonly>

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                        aria-selected="true">Content</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details"
                                        type="button" role="tab" aria-controls="details"
                                        aria-selected="false">Details</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images"
                                        type="button" role="tab" aria-controls="images"
                                        aria-selected="false">Images</button>
                                </li>
                            </ul>
                            <div class="tab-content border p-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="form-group mb-3">
                                        <label>Product name</label>
                                        <input type="text" class="form-control" name="name" value="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Price</label>
                                        <input type="text" class="form-control" name="price" value="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Discount</label>
                                        <input type="text" class="form-control" name="discount" value="0">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Product description</label>
                                        <textarea id="description" name="description" class="form-control" cols="30" rows="10"></textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Category</label>
                                        <select class="form-select" name="category_id">
                                            <option selected disabled>Select category</option>
                                            @foreach ($categories as $key => $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Tags</label>
                                        <select class="form-select select-tags" name="tags[]" multiple="multiple">
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Quantity</label>
                                        <input type="number" class="form-control" name="quantity" value="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Status</label>
                                        <select class="form-select" name="status">
                                            <option selected disabled>Select status</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                                    <div class="form-group mb-3">
                                        <label>Màu sắc</label>
                                        <input type="text" class="form-control" name="color" value="">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Xuất xứ </label>
                                        <input type="text" class="form-control" name="screen_technology"
                                            value="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Thương hiệu </label>
                                        <input type="text" class="form-control" name="os" value="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Chất liệu</label>
                                        <input type="text" class="form-control" name="cpu" value="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Loại khóa cài</label>
                                        <input type="text" class="form-control" name="resolution" value="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Đuôi gió</label>
                                        <input type="text" class="form-control" name="front_camera" value="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Kính</label>
                                        <input type="text" class="form-control" name="rear_camera" value="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Lót trong</label>
                                        <input type="text" class="form-control" name="ram" value="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Bảo hành</label>
                                        <input type="text" class="form-control" name="rom" value="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Phụ kiện kèm theo</label>
                                        <input type="text" class="form-control" name="sim" value="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Kích cỡ</label>
                                        <input type="text" class="form-control" name="pin" value="">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                    <div class="form-group mb-3">
                                        <label>Ảnh nón</label>
                                        <input type="file" class="form-control" name="featured_image">
                                        <div class="row mt-3">
                                            <div class="col-sm-3 featured-image-container">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Ảnh chi tiết sản phẩm</label>
                                        <input type="file" class="form-control" name="product_images[]" multiple>
                                        <div class="row mt-3 product-image-container">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Send</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/js/select2.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script src="{{ asset('backend/js/product.js') }}"></script>

@endsection
