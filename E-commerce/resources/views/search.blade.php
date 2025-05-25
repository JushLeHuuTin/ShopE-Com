@extends('header')

@section('content')
<div class="content">
<div class="header-msg__wrapper overflow-hidden d-flex">

    <div class="container-fluid p-0">
        <div class="container">
            <div class="mb-5">
                <div class="breadcrum my-3 text-start">
                    <span>
                        <a href="" class="text-dark text-decoration-none"
                            style="letter-spacing: 1px; font-size:1rem; ">Thời trang Overflow<span class=" fs-5"> > </span></a>
                    </span>
                    <span>
                        <a href="" class="text-dark text-decoration-none"
                            style="letter-spacing: 1px; font-size:1rem; ">Search results for "{{$search }}"</a>
                    </span>
                </div>
                <div class=" font-bold fs-2">
                    Kết quả tìm kiếm:
                </div>
            </div>
            <!-- Display feature product  -->
            <div class="row content-first mb-4">
                @forelse($products as $product)
                <a href="{{ route('product.detail', $product->id_product) }}" class=" text-decoration-none col-md-3 border-end border-dark border-bottom overflow-hidden">
                    <div class="content-product__item">
                        <img src="{{ asset('images/' . $product->image_url) }}" alt=""
                            class="w-100 content-first__img px-3 py-4">
                        <div class="content-product__item-info px-4 py-3 border-top border-dark"
                            style="margin: 0 -12px;">
                            <h3 class="text-link fs-6" style="margin: 0;">{{ $product->name }}</h3>
                            <span class="fs-6 fw-bold text-dark">
                                @isset($product->defaultVariant->price)
                                {{ number_format($product->defaultVariant->price, 0, ',', '.') }}₫
                            @endisset
                            </span>
                        </div> 
                    </div>
                </a>
                @empty
                <p>Không có sản phẩm nổi bật nào.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection