@extends('frontend.layout.app')
@section('title')
    {{ mb_convert_case('trang chủ', MB_CASE_TITLE, 'UTF-8') }}
@endsection
@section('content')
    {{-- {{ dd($colorLists) }} --}}
    <!--MAIN SLIDE-->
    <div class="wrap-main-slide">
        <div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-autoplay="false" data-autoplayTimeout="5000"
            data-loop="true" data-slideSpeed="1500" data-nav="true" data-dots="false">
            <div class="item-slide">
                <img src="{{ asset('storage/app/slider1.jpg') }}" alt="" class="img-slide">
            </div>
            <div class="item-slide">
                <img src="{{ asset('storage/app/slider2.jpg') }}" alt="" class="img-slide">
            </div>
        </div>
    </div>

    <!--featured products-->
    <div class="wrap-show-advance-info-box style-1 has-countdown">
        <h3 class="title-box">sản phẩm nổi bật</h3>
        <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
            data-autoplay="true" data-autoplayTimeout="5000" data-loop="true" data-slideSpeed="1000" data-nav="true"
            data-dots="false"
            data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
            @foreach ($featuredProducts as $item)
                <div class="product product-style-2 equal-elem ">
                    <div class="product-thumnail">
                        <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}"
                            title="{{ $item->name }}">
                            <figure><img src="{{ asset('storage/products/' . $item->featured_image) }}" width="800"
                                    height="800" alt="{{ $item->name }}"></figure>
                        </a>
                        <div class="group-flash">
                            <span class="flash-item sale-label">sale</span>
                        </div>
                        <div class="wrap-btn">
                            <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}"
                                class="function-link">quick
                                view</a>
                        </div>
                    </div>
                    <div class="product-info">
                        <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}"
                            class="product-name"><span>{{ $item->name }}</span></a>
                        <div class="wrap-price">
                            @if ($item->discount == 0)
                                <span class="product-price">{{ number_format($item->price, 0, '.', '.') }}đ</span>
                            @else
                                <span>
                                    <p class="product-price">
                                        {{ number_format($item->price - $item->discount, 0, '.', '.') }}đ</p>
                                </span>
                                <del>
                                    <p class="product-price">{{ number_format($item->price, 0, '.', '.') }}đ</p>
                                </del>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!--Latest Products-->
    <div class="wrap-show-advance-info-box style-1">
        <h3 class="title-box">sản phẩm mới nhất</h3>
        <div class="wrap-top-banner">
            <a href="#" class="link-banner banner-effect-2">
                <figure><img src="{{ asset('storage/app/banner-leng.jpg') }}" width="1170" height="240" alt="">
                </figure>
            </a>
        </div>
        <div class="wrap-products">
            <div class="wrap-product-tab tab-style-1">
                <div class="tab-contents">
                    <div class="tab-content-item active" id="digital_1a">
                        <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                            data-autoplay="true" data-autoplayTimeout="5000" data-loop="true" data-slideSpeed="1000"
                            data-nav="true" data-dots="false"
                            data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>

                            @for ($i = 0; $i < $latestProductQuantities;)
                                <div class="owl-item-col">
                                    @for ($j = 0; $j < 2; $j++, $i++)
                                        <div class="item-1">
                                            <div class="product product-style-2 equal-elem ">
                                                <div class="product-thumnail">
                                                    <a href="{{ route('product_detail', ['slug' => $latestProducts[$i]->slug, 'code' => $latestProducts[$i]->code]) }}"
                                                        title="{{ $latestProducts[$i]->name }}">
                                                        <figure><img
                                                                src="{{ asset('storage/products/' . $latestProducts[$i]->featured_image) }}"
                                                                width="800" height="800"
                                                                alt="{{ $latestProducts[$i]->name }}">
                                                        </figure>
                                                    </a>
                                                    <div class="group-flash">
                                                        <span class="flash-item sale-label">sale</span>
                                                    </div>
                                                    <div class="wrap-btn">
                                                        <a href="{{ route('product_detail', ['slug' => $latestProducts[$i]->slug, 'code' => $latestProducts[$i]->code]) }}"
                                                            class="function-link">quick view</a>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <a href="{{ route('product_detail', ['slug' => $latestProducts[$i]->slug, 'code' => $latestProducts[$i]->code]) }}"
                                                        class="product-name"><span>{{ $latestProducts[$i]->name }}</span></a>
                                                    <div class="wrap-price">
                                                        @if ($latestProducts[$i]->discount == 0)
                                                            <span
                                                                class="product-price">{{ number_format($latestProducts[$i]->price, 0, '.', '.') }}đ</span>
                                                        @else
                                                            <span>
                                                                <p class="product-price">
                                                                    {{ number_format($latestProducts[$i]->price - $latestProducts[$i]->discount, 0, '.', '.') }}đ
                                                                </p>
                                                            </span>
                                                            <del>
                                                                <p class="product-price">
                                                                    {{ number_format($latestProducts[$i]->price, 0, '.', '.') }}đ
                                                                </p>
                                                            </del>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            @endfor

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Product Categories-->
    <div class="wrap-show-advance-info-box style-1">
        <h3 class="title-box">sản phẩm theo danh mục</h3>
        <div class="wrap-products">
            <div class="wrap-product-tab tab-style-1">
                <div class="tab-control">
                    @foreach ($categories as $key => $item)
                        <a href="#fashion_{{ $key }}"
                            class="tab-control-item {{ $key == 0 ? 'active' : '' }}">{{ $item->name }}</a>
                    @endforeach
                </div>
                <div class="tab-contents">
                    @foreach ($categories as $key => $item)
                        <div class="tab-content-item {{ $key == 0 ? 'active' : '' }}" id="fashion_{{ $key }}">
                            <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container"
                                data-items="5" data-autoplay="true" data-autoplayTimeout="5000" data-loop="true"
                                data-slideSpeed="1000" data-nav="true" data-dots="false"
                                data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>

                                @foreach ($item->products as $product)
                                    <div class="product product-style-2 equal-elem ">
                                        <div class="product-thumnail">
                                            <a href="{{ route('product_detail', ['slug' => $product->slug, 'code' => $product->code]) }}"
                                                title="{{ $product->name }}">
                                                <figure><img
                                                        src="{{ asset('storage/products/' . $product->featured_image) }}"
                                                        width="800" height="800" alt="{{ $product->name }}">
                                                </figure>
                                            </a>
                                            <div class="group-flash">
                                                <span class="flash-item sale-label">new</span>
                                            </div>
                                            <div class="wrap-btn">
                                                <a href="{{ route('product_detail', ['slug' => $product->slug, 'code' => $product->code]) }}"
                                                    class="function-link">quick view</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('product_detail', ['slug' => $product->slug, 'code' => $product->code]) }}"
                                                class="product-name"><span>{{ $product->name }}</span></a>
                                            <div class="wrap-price">
                                                @if ($product->discount == 0)
                                                    <span
                                                        class="product-price">{{ number_format($product->price, 0, '.', '.') }}đ</span>
                                                @else
                                                    <span>
                                                        <p class="product-price">
                                                            {{ number_format($product->price - $product->discount, 0, '.', '.') }}đ
                                                        </p>
                                                    </span>
                                                    <del>
                                                        <p class="product-price">
                                                            {{ number_format($product->price, 0, '.', '.') }}đ
                                                        </p>
                                                    </del>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
