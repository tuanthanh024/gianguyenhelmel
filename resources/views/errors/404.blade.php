@extends('frontend.layout.app')

@section('title')
    {{ mb_convert_case('không tìm thấy trang yêu cầu', MB_CASE_TITLE, 'UTF-8') }}
@endsection

@section('css')
    <style>
        img {
            width: 220px;
            height: auto;
            max-width: 300px;
        }

        h3 {
            font-weight: 600;
        }

        p {
            margin-bottom: 5px;
        }

        a#error {
            text-transform: uppercase;
            font-size: 14px;
            padding: 10px 20px;
        }
    </style>
@endsection

@section('content')
    <div class="main-content-area">
        <div class="row">
            <div class="col-md-12 text-center pt-20 pb-50">
                <img src="{{ asset('storage/app/bubble-gum-error-404.gif') }}" alt="">
                <h3>Địa chỉ không hợp lệ</h3>
                <p>Địa chỉ URL bạn yêu cầu không tìm thấy trên server.</p>
                <p>Có thể bạn gõ sai địa chỉ hoặc dữ liệu này đã bị xóa khỏi server.</p>
                <a href="{{ route('home') }}" id="error" class="btn btn-submit btn-submitx">quay lại trang chủ</a>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
