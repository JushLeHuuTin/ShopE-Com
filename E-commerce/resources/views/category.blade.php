@extends('header')

@section('content')
    <div class="content" style="margin:0 30px">
        <div class="row">
            <div class="col-3 d-none d-lg-block">
                <div class="category">
                    <h4 class="category-title bg-success p-2 text-center text-white" style="margin:50px 0 20px 0">
                        DANH MỤC SẢN PHẨM
                    </h4>
                    <ul class="category__list p-0" style="list-style: none; max-height: 390px; overflow-y: auto;">
                        @foreach ($categories as $item)
                            <li class="category__item py-1">
                                <a href="{{ route('category.show', $item->slug) }}"
                                   class="category__item-link text-dark text-decoration-none">{{ $item->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-12">
                <div class="container-fluid p-0">
                    <div class="content__product-heading">
                        <div class="breadcrum my-3 text-start">
                            <span>
                                <a href="" class="text-dark text-decoration-none"
                                   style="letter-spacing: 1px; font-size:1rem; font-weight:500">Thời trang Overflow > </a>
                            </span>
                            <span>
                                <a href="" class="text-dark text-decoration-none"
                                   style="letter-spacing: 1px; font-size:1rem; font-weight:500"> {{ $category->name }}</a>
                            </span>
                        </div>
                        <div class="container__category-heading text-center fs-2">
                            {{ $category->name }}
                        </div>
                    </div>
                    <!-- Display product -->
                    @isset($products[0])
                        <div class="total-product">
                            Hiển thị tất cả {{ $products->count() }} kết quả
                        </div>
                    @endisset
                    <div class="row content-first border-none mb-4" style="border:none; margin:10px 0">
                        @forelse($products as $product)
                            <a href="{{ route('product.detail', $product->id_product) }}"
                               class="border text-decoration-none col-md-3 border-dark overflow-hidden">
                                <div class="content-product__item">
                                    <img src="{{ asset('images/' . $product->image_url) }}" alt=""
                                         class="w-100 content-first__img px-3 py-4" style="height: 300px">
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
                            <p class="p-3" style="background-color:#FEF3CD;color:#aa8f4b;">Không tìm thấy sản phẩm nào
                                khớp với lựa chọn của bạn.</p>
                        @endforelse
                    </div>
                </div>
                {{ $products->links() }}
            </div>
        </div>
    @endsection