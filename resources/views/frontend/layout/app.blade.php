<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.ico') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/flexslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/chosen.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/color-01.css') }}">
    @yield('css')
</head>

<body class="home-page home-01 ">





    @include('frontend.blocks.header')

    <main id="main">
        <div class="container">
            @yield('content')
        </div>
    </main>

    @include('frontend.blocks.footer')







    <script src="{{ asset('frontend/js/jquery-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('frontend/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('frontend/js/functions.js') }}"></script>
    <script>
        $(document).ready(function() {
            var currentUrl = window.location.href.split('?')[0].replace("#", "").replace(/\/$/, '');

            var check = false;
            $('.primary .menu-item').each(function(i) {
                var children = $(this).children().first();
                if (children.attr('href') == currentUrl) {
                    $(this).addClass('home-icon');
                    check = true;
                }
            });

            if (!check) {
                $('.primary .menu-item').first().addClass('home-icon');
            }

            var $backToTop = $("#back-to-top-btn");


            $(window).on('scroll', function() {
                if ($(this).scrollTop() > 100) {
                    $backToTop.css('transform', 'translate3d(0px, 0, 0)');
                } else {
                    $backToTop.css('transform', 'translate3d(70px, 0, 0)');
                }
            });

            $backToTop.on('click', function(e) {
                $("html, body").animate({
                    scrollTop: 0
                }, 500);
            });


        });
    </script>
    {{-- search --}}
    <script>
        $(document).ready(function() {
            var timeoutId = 0;

            $('input[name="q"]').keyup(function(e) {
                var searchValue = $(this).val();
                $('.search-result-box').html('');
                if (searchValue != '') {
                    let expression = new RegExp(searchValue, 'i');
                    if (timeoutId) clearTimeout(timeoutId);
                    timeoutId = setTimeout(function() {
                        $.getJSON("/json/products.json", function(data) {
                            $.each(data, function(indexInArray, valueOfElement) {
                                if (valueOfElement.name.search(expression) != -1) {
                                    $('.search-result-box').css({
                                        opacity: 1,
                                        visibility: 'visible'
                                    }).show();
                                    let priceOrigin = valueOfElement.price
                                        .toString().replace(
                                            /\B(?=(\d{3})+(?!\d))/g, ".");
                                    let priceSale = (valueOfElement.price -
                                        valueOfElement
                                        .discount).toString().replace(
                                        /\B(?=(\d{3})+(?!\d))/g, ".");
                                    $('.search-result-box').append(
                                        '<li>' +
                                        '<a href="/product/' + valueOfElement
                                        .slug + '-' +
                                        valueOfElement.code + '">' +
                                        '<div class="img-box">' +
                                        '<img src="/storage/products/' +
                                        valueOfElement
                                        .featured_image + '" alt="">' +
                                        '</div>' +
                                        '<div class="info-box">' +
                                        '<div class="info-title">' +
                                        valueOfElement.name +
                                        '</div>' +
                                        '<div class="info-price">' +
                                        (valueOfElement.discount == 0 ?
                                            '<div class="price-sale">' +
                                            priceOrigin + 'đ</div>' :
                                            '<div class="price-sale">' +
                                            priceSale + 'đ</div>' +
                                            '<div class="price-origins">' +
                                            priceOrigin + 'đ</div>') +

                                        '</div>' +
                                        '</div>' +
                                        '</a>' +
                                        '</li>');
                                }
                            });
                        });
                    }, 200);
                } else {
                    $('.search-result-box').css({
                        opacity: 0,
                        visibility: 'hidden'
                    }).html('');
                }
            });


            $(document).on('click', '.search-result-box li a', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $(this).closest('.search-result-box').html('')
                location.href = url
            });


            $(document).mouseup(function(e) {
                var container = $('.search-result-box');
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.html('');
                }
            });
        });
    </script>
    @yield('js')

</body>

</html>
