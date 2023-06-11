@extends('backend.layout.app')
@section('title', 'Edit Product')

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/css/select2.css') }}">
@endsection

@section('content')
    @include('backend.blocks.breadcrumb', [
        'page_title' => 'products',
        'current_page' => 'edit products',
    ])
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form class="w-75" action="{{ route('admin.products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" class="form-control" name="slug" value="{{ $product->slug }}" readonly>

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
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $product->name }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Price</label>
                                        <input type="text" class="form-control" name="price"
                                            value="{{ $product->price }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Discount</label>
                                        <input type="text" class="form-control" name="discount"
                                            value="{{ $product->discount }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Product description</label>
                                        <textarea id="description" name="description" class="form-control" cols="30" rows="10">{{ $product->description }}</textarea>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Category</label>
                                        <select class="form-select" name="category_id">
                                            <option selected disabled>Select category</option>
                                            @foreach ($categories as $key => $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $product->category_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Tags</label>
                                        <select class="form-select select-tags" name="tags[]" multiple="multiple">
                                            @foreach ($product->tags as $item)
                                                <option value="{{ $item->name }}" selected>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Quantity</label>
                                        <input type="number" class="form-control" name="quantity"
                                            value="{{ $product->quantity }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Status</label>
                                        <select class="form-select" name="status">
                                            <option selected disabled>Select status</option>
                                            <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="inactive"
                                                {{ $product->status == 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                                    <div class="form-group mb-3">
                                        <label>Color</label>
                                        <input type="text" class="form-control" name="color"
                                            value="{{ $product->color }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Screen technology</label>
                                        <input type="text" class="form-control" name="screen_technology"
                                            value="{{ $product->screen_technology }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Operating system</label>
                                        <input type="text" class="form-control" name="os"
                                            value="{{ $product->os }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>CPU</label>
                                        <input type="text" class="form-control" name="cpu"
                                            value="{{ $product->os }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Resolution</label>
                                        <input type="text" class="form-control" name="resolution"
                                            value="{{ $product->resolution }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Front camera</label>
                                        <input type="text" class="form-control" name="front_camera"
                                            value="{{ $product->front_camera }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Rear camera</label>
                                        <input type="text" class="form-control" name="rear_camera"
                                            value="{{ $product->rear_camera }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Ram</label>
                                        <input type="text" class="form-control" name="ram"
                                            value="{{ $product->ram }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Rom</label>
                                        <input type="text" class="form-control" name="rom"
                                            value="{{ $product->rom }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Sim</label>
                                        <input type="text" class="form-control" name="sim"
                                            value="{{ $product->sim }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Pin</label>
                                        <input type="text" class="form-control" name="pin"
                                            value="{{ $product->pin }}">
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                    <div class="form-group mb-3">
                                        <label>Featured image</label>
                                        <input type="file" class="form-control" name="featured_image">
                                        <div class="row mt-3">
                                            <div class="col-sm-3 featured-image-container">
                                                <img src="{{ asset('storage/products/' . $product->featured_image) }}"
                                                    class="img-fluid img-thumbnail" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Product images</label>
                                        <input type="file" class="form-control" name="product_images[]" multiple>
                                        <div class="row mt-3 product-image-container">
                                            @foreach ($product->productImages as $item)
                                                <div class="col-sm-3 mb-3">
                                                    <img src="{{ asset('storage/products/' . $item->name) }}"
                                                        class="img-fluid img-thumbnail" alt="">
                                                </div>
                                            @endforeach
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
