@extends('layout.admin')

@section('title', 'Quản lý Mã giảm giá')

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="border-bottom pb-2 mb-4 h5">Thêm mã Voucher</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('voucher.postVoucher') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3 justify-content-center">
                        <div class="col-md-8">
                            <label class="form-label">Mã giảm giá</label>
                            <input name="code" type="text" class="form-control form-control-sm" />
                            @if ($errors->has('code'))
                                <div class="text-danger small">{{ $errors->first('code') }}</div>
                            @endif
                        </div>

                        <div class="col-md-8">
                            <label class="form-label">Phần trăm giảm giá</label>
                            <input name="discount_value" type="number"
                                onkeydown="return !['e', 'E', '+', '-'].includes(event.key)" step="0.01"
                                class="form-control form-control-sm" />
                            @if ($errors->has('discount_value'))
                                <div class="text-danger small">{{ $errors->first('discount_value') }}</div>
                            @endif
                        </div>

                        <div class="col-md-8">
                            <label class="form-label">Ngày kết thúc</label>
                            <input type="date" name="expiration_date" class="form-control form-control-sm" max="2099-12-31T23:59"/>
                            @if ($errors->has('expiration_date'))
                                <div class="text-danger small">{{ $errors->first('expiration_date') }}</div>
                            @endif
                        </div>

                      
                        <div class="col-md-8">
                            <label class="form-label">Số lần sử dụng</label>
                            <input name="max_uses" type="number" min="1"
                                onkeydown="return !['e', 'E', '+', '-'].includes(event.key)"
                                class="form-control form-control-sm" />
                            @if ($errors->has('max_uses'))
                                <div class="text-danger small">{{ $errors->first('max_uses') }}</div>
                            @endif
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" style="border:1px solid black; box-shadow:1px 1px 1px black" class="btn btn-submit btn-primary btn-sm">Thêm mới</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
