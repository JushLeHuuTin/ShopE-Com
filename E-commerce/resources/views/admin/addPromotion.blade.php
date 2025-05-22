@extends('layout.admin')

@section('title', 'Thêm Khuyến Mãi')

@section('content')
<div class="container mt-4">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h1 class="border-bottom pb-2 mb-4 h5">Thêm Khuyến Mãi</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('promotion.postPromotion') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3 justify-content-center">
                    <div class="col-md-8">
                        <label class="form-label">Tên chương trình</label>
                        <input name="name" type="text" class="form-control form-control-sm" />
                        @if ($errors->has('name'))
                        <div class="text-danger small">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">Mức giảm giá</label>
                        <input name="discount_value" type="number"
                            onkeydown="return !['e', 'E', '+', '-'].includes(event.key)" step="0.01"
                            class="form-control form-control-sm" />
                        @if ($errors->has('discount_value'))
                        <div class="text-danger small">{{ $errors->first('discount_value') }}</div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Ngày bắt đầu</label>
                        <input type="date" name="start_date" class="form-control form-control-sm" max="2099-12-31T23:59" />
                        @if ($errors->has('start_date'))
                        <div class="text-danger small">{{ $errors->first('start_date') }}</div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Ngày kết thúc</label>
                        <input type="date" name="end_date" class="form-control form-control-sm" max="2099-12-31T23:59" />
                        @if ($errors->has('end_date'))
                        <div class="text-danger small">{{ $errors->first('end_date') }}</div>
                        @endif
                    </div>


                    <div class="col-md-8">
                        <label class="form-label">Sản phẩm áp dụng</label>
                        <select name="id_product" class="form-select form-select-sm">
                            <option value="0">Chọn sản phẩm</option>
                            @foreach($products as $item)
                            <option value="{{$item->id_product}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" style="border:1px solid black; box-shadow:1px 1px 1px black" class="btn btn-primary btn-sm">Thêm mới</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection