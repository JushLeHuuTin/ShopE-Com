@extends('layout.admin')

@section('title', 'Thêm Sản Phẩm Vào Chương Trình')

@section('content')
<div class="container mt-4">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <h1 class="border-bottom pb-2 mb-4 h5">Thêm Sản Phẩm</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('promotionProduct.postAdd') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3 justify-content-center">
                    <div class="col-md-8">
                        <label class="form-label">Tên chương trình</label>
                        <select name="promotion" class="form-select form-select-sm">
                            <option value="0">Chọn chương trình</option>
                            @foreach ($promotions as $item)
                            @if($item->id_promotion == $promotion->id_promotion)
                            <option value="{{ $item->id_promotion }}" selected>{{ $item->name }}</option>
                            @else
                            <option value="{{ $item->id_promotion }}">{{ $item->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Tên Sản Phẩm</label>
                        <select name="product" class="form-select form-select-sm">
                            <option value="0">Chọn sản phẩm</option>
                            @foreach ($products as $item)
                            <option value="{{ $item->id_product }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8">
                        <button type="submit" class="bg-primary py-1 px-2 w-100">Lưu thay đổi</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection