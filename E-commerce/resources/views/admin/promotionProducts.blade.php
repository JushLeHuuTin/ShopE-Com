@extends('layout.admin')

@section('content')
<h1 class="mb-4">
    Danh sách sản phẩm thuộc chương trình khuyến mãi:
    <strong class="text-primary">{{ $promotion->name }}</strong>
</h1>
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@elseif(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="mb-3 text-end">
    <a href="{{ route('promotionProduct.addForm', $promotion->id_promotion) }}" class="btn btn-primary btn-sm">
        + Thêm sản phẩm vào chương trình
    </a>
</div>
@if ($products->isEmpty())
<div class="alert alert-warning">Không có sản phẩm nào trong khuyến mãi này.</div>
@else
<table class="table table-bordered table-striped align-middle">
    <thead class="table-light">
        <tr>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá gốc</th>
            <th>Giá sau giảm</th>
            <th>Trạng thái</th>
            <th class="text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        @php
        $originalPrice = optional($product->defaultVariant)->price;
        $discountedPrice = $originalPrice
        ? $originalPrice * (1 - $promotion->discount_value / 100)
        : null;
        @endphp
        <tr>
            <td style="width: 100px;">
                <img src="{{ asset('images/' . $product->image_url) }}"
                    alt="{{ $product->name }}"
                    class="img-thumbnail"
                    style="max-width: 80px;">
            </td>
            <td>{{ $product->name }}</td>
            <td>
                @if ($originalPrice)
                {{ number_format($originalPrice, 0, ',', '.') }} đ
                @else
                <em class="text-muted">Không có</em>
                @endif
            </td>
            <td class="text-success fw-bold">
                @if ($discountedPrice)
                {{ number_format($discountedPrice, 0, ',', '.') }} đ
                @else
                <em class="text-muted">Không có</em>
                @endif
            </td>
            <td>
                <span class="badge bg-success">Còn hàng</span>
                <!-- @if ($product->status) -->
                <!-- @else -->
                <!-- <span class="badge bg-secondary">Hết hàng</span> -->
                <!-- @endif -->
            </td>
            <td class="text-center">
                <form action="{{ route('promotionProduct.delete', [$promotion->id_promotion, $product->id_product]) }}"
                    method="get"
                    onsubmit="return confirm('Bạn chắc chắn muốn xoá sản phẩm khỏi chương trình khuyến mãi này?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection