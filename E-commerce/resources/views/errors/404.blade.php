@extends('header')
@section('title', 'Không tìm thấy trang')


@section('content')
<div class="d-flex flex-column justify-items-center align-items-center mt-5">

    <h1 class=" fs-5 font-bold">404 NOT FOUND</h1>
    <div class="">
        <p>Trang bạn tìm kiếm không tồn tại.
        <a href="{{ url('/') }}">Quay lại trang chủ</a>

        </p>

    </div>
</div>
@endsection
