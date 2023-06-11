<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/images/favicon.png') }}">
    {{-- <link href="{{ asset('backend/plugins/chartist-js/dist/chartist.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('backend/plugins/chartist-js/dist/chartist-init.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('backend/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}"
        rel="stylesheet"> --}}
    {{-- <link href="{{ asset('backend/plugins/c3-master/c3.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('backend/css/style.min.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"> --}}
    @yield('css')
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        @include('backend.blocks.header')
        @include('backend.blocks.sidebar')
        <div class="page-wrapper">


            @yield('content')

            {{-- Footer --}}

            @include('backend.blocks.footer')

        </div>
    </div>
    {{-- toast  --}}
    @if (session('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1000">
            <div class="toast alert-success" style="border-radius: 5px;background-color: #d1e7dd;" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <script src="{{ asset('backend/plugins/jquery/dist/jquery.min.js') }}"></script>
    {{-- <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> --}}
    <script>
        $(function() {
            // $("#data-table").dataTable();
        })
    </script>
    {{-- <script>
        $(document).ready(function() {
            $('.form-delete').submit(() => confirm('Are you sure you want to delete?'))
        })
    </script> --}}
    <script type="text/javascript">
        function changeToSlug() {
            var slug;
            //Lấy text từ thẻ input title 
            slug = document.querySelector('input[name="name"]').value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.querySelector('input[name="slug"]').value = slug;
        }
        const nameInput = document.querySelector('input[name="name"]');
        if (nameInput) {
            nameInput.onkeyup = changeToSlug;
        }
    </script>
    <script src="{{ asset('backend/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('backend/js/app-style-switcher.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/js/waves.js') }}"></script> --}}
    <script src="{{ asset('backend/js/sidebarmenu.js') }}"></script>
    {{-- <script src="{{ asset('backend/plugins/chartist-js/dist/chartist.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}">
    </script> --}}
    {{-- <script src="{{ asset('backend/plugins/d3/d3.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/plugins/c3-master/c3.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/js/pages/dashboards/dashboard1.js') }}"></script> --}}
    <script src="{{ asset('backend/js/custom.js') }}"></script>
    <script>
        window.onload = function() {
            var sp = new SuperPlaceholder({
                placeholders: ["Search here...", "What are you looking for?"],
                // preText: "Eg. ",
                stay: 1000,
                speed: 100,
                element: '#dynamic-placeholder'
            });
            sp.init();
        }
        var SuperPlaceholder = function(options) {
            this.options = options;
            this.element = options.element
            this.placeholderIdx = 0;
            this.charIdx = 0;


            this.setPlaceholder = function() {
                placeholder = options.placeholders[this.placeholderIdx];
                var placeholderChunk = placeholder.substring(0, this.charIdx + 1);
                document.querySelector(this.element).setAttribute("placeholder",
                    placeholderChunk)
            };

            this.onTickReverse = function(afterReverse) {
                if (this.charIdx === 0) {
                    afterReverse.bind(this)();
                    clearInterval(this.intervalId);
                    this.init();
                } else {
                    this.setPlaceholder();
                    this.charIdx--;
                }
            };

            this.goReverse = function() {
                clearInterval(this.intervalId);
                this.intervalId = setInterval(this.onTickReverse.bind(this, function() {
                    this.charIdx = 0;
                    this.placeholderIdx++;
                    if (this.placeholderIdx === options.placeholders.length) {
                        // end of all placeholders reached
                        this.placeholderIdx = 0;
                    }
                }), this.options.speed)
            };

            this.onTick = function() {
                var placeholder = options.placeholders[this.placeholderIdx];
                if (this.charIdx === placeholder.length) {
                    // end of a placeholder sentence reached
                    setTimeout(this.goReverse.bind(this), this.options.stay);
                }

                this.setPlaceholder();

                this.charIdx++;
            }

            this.init = function() {
                this.intervalId = setInterval(this.onTick.bind(this), this.options.speed);
            }

            this.kill = function() {
                clearInterval(this.intervalId);
            }
        }
    </script>

    <script>
        // var alert = new bootstrap.Toast(document.querySelector('.toast'))
        // if (alert) {

        //     alert.show()
        // }

        // // Sau 3 giây, thông báo sẽ tự động biến mất
        // setTimeout(() => {
        //     alert.hide()
        // }, 3000)
    </script>
    @yield('js')

</body>

</html>
