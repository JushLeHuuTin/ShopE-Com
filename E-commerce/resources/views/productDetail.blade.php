@extends('header')

@section('content')
    <div class="content">
        <div class="container">
            {{-- Breadcrumb --}}
            <div class="breadcrum my-3">
                <span>
                    <a href="" class="text-dark text-decoration-none" style="letter-spacing: 1px;">Thời trang Overflow
                        ></a>
                </span>
                <span>
                    <a href="{{ route('category.show', $product->category->slug) }}" class="text-dark text-decoration-none"
                        style="letter-spacing: 1px;">
                        {{ $product->category->name }} >
                    </a>
                </span>
                <span>
                    <a href="" class="text-dark text-decoration-none" style="letter-spacing: 1px;">
                        {{ $product->name }}
                    </a>
                </span>
            </div>

            {{-- Product content --}}
            <div class="content_post">
                <div class="row">
                    {{-- Product image --}}
                    <div class="col-lg-6 col-md-12">
                        <div class="product__gallery">
                            <div class="product__gallery--img-wrapper">
                                <img src="{{ asset('images/' . $product->image_url) }}" alt=""
                                    class="product__gallery--img w-100">
                            </div>
                        </div>
                    </div>

                    {{-- Product info --}}
                    <div class="col-lg-6 col-md-12">
                        <div class="product__information">
                            <div class="product__information--name fs-2 text-dark mb-3">
                                {{ $product->name }}
                            </div>
                            <div class="product__information--price fs-4 my-2">
                                Giá bán: <span class="fs-4 text-danger ">
                                    @if (isset($product->defaultVariant->price))
                                        @if (isset($variant))
                                            {{ number_format($variant->price, 0, ',', '.') }}₫
                                        @else
                                            {{ number_format($product->defaultVariant->price, 0, ',', '.') }}₫
                                        @endif
                                    @else
                                        Chưa được cập nhật
                                    @endif
                                </span>
                            </div>

                            {{-- Sizes --}}
                            <div class="product__information--size d-flex align-items-center gap-2">
                                <label class="fs-5">Size</label>
                                @if (isset($product->Product_Variants[0]))
                                    <form method="get"
                                        action="{{ route('product.show', ['id' => $product->id_product]) }}">
                                        <ul class="product__size--list list-unstyled d-flex m-0">
                                            @foreach ($product->Product_Variants as $variant)
                                                <li class="product__size--item border border-dark mx-1"
                                                    style="border-radius: 4px;">
                                                    <label style="cursor:pointer;" class="w-100 h-100 py-1 px-2"
                                                        onclick="this.form.submit()">
                                                        <input type="radio" hidden name="variant_id"
                                                            value="{{ $variant->id_variant }}"
                                                            {{ request('variant_id') == $variant->id_variant ? 'checked' : '' }}>
                                                        {{ $variant->size }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </form>
                                @else
                                    <span>Chưa có size nào.</span>
                                @endif
                            </div>

                            {{-- Add to cart --}}
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="variant_id" value="{{ request('variant_id') }}">
                                <div class="product__information--add d-flex my-3">
                                    <div class="quantity">
                                        <button type="button" class="btn__quantity btn__remove">-</button>
                                        <input type="number" name="quantity" value="1" class="input__quantity">
                                        <button type="button" class="btn__quantity btn__add">+</button>
                                    </div>
                                    <button type="submit" class="mx-3 w-75 btn__add-cart bg-success text-white">THÊM VÀO
                                        GIỎ HÀNG</button>
                                </div>
                            </form>

                            {{-- Social --}}
                            <div class="product__information--social d-flex align-items-center">
                                <label>Chia sẻ: </label>
                                <ul
                                    class="m-0 product__share d-flex list-unstyled align-items-center justify-content-center gap-1 ms-3">
                                    @foreach (['facebook', 'twitter', 'envelope', 'pinterest', 'linkedin'] as $icon)
                                        <li class="share__item d-flex align-items-center justify-content-center"
                                            style="width:35px;height:35px; border: 1px solid ; border-radius:50%">
                                            <a href="" class="share__item--link text-decoration-none text-dark fs-5">
                                                <i class="fa-brands fa-{{ $icon }}"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Tabs --}}
                    <div class="col-12">
                        <nav class="nav__tabs mt-5">
                            <ul class="tab__list d-flex list-unstyled m-0">
                                <li class="tab__item px-4 bg-white py-2 border tab__active">
                                    <a href="#" class="tab__item--link text-decoration-none text-dark">Mô tả</a>
                                </li>
                                <li class="tab__item px-4 bg-white py-2 border">
                                    <a href="#" class="tab__item--link text-decoration-none text-dark">Đánh giá</a>
                                </li>
                            </ul>
                        </nav>

                        <div class="tab__content border w-100">
                            {{-- Tab mô tả --}}
                            <div class="tab__panel px-3 py-5">
                                <div class="product-description">
                                    {{ $product->description ?? 'Trống' }}
                                </div>
                                <div class="write-comment">
                                    <a href="{{ route('review.display', ['id' => $product->id_product]) }}"
                                        class="text-decoration-none fs-5">🖌 Viết đánh giá</a>
                                </div>
                            </div>

                            {{-- Tab đánh giá --}}
                            <div class="tab__panel px-3 d-none">
                                <div class="product-review">
                                    @if (isset($averageRating))
                                        <div class="title my-2 fs-5">
                                            {{ $averageRating }}⭐ Đánh giá sản phẩm ({{ $commentCount }})
                                        </div>
                                    @endif
                                    @if (isset($comments))
                                        @if ($comments->isEmpty())
                                            <p>Chưa có đánh giá cho sản phẩm này</p>
                                            <p>Để lại bình luận</p>
                                            <p>Bạn cần <a href="{{ route('login') }}" class="text-success">đăng nhập</a> để
                                                phản hồi</p>
                                        @else
                                            @foreach ($comments as $comment)
                                                <div class="card mb-4">
                                                    <div class="card-body" style="background: #efefef;">
                                                        <div class="card-item">
                                                            <div class="card-infor d-flex gap-3 align-items-center">
                                                                <img style="width:40px;"
                                                                    src="{{ asset('images/user.png') }}" alt="">
                                                                <div class="user-name">{{ $comment->username }}</div>
                                                            </div>
                                                            <div class="card-rating my-2">
                                                                {{ str_repeat('⭐', $comment->rating) }}
                                                            </div>
                                                            <div class="card-product-name my-2">
                                                                {{ $comment->product_name }}
                                                            </div>
                                                            <p>{{ $comment->comment }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            @if ($commentCount > 3)
                                                <div class="text-center">
                                                    <a class="text-decoration-none fs-5"
                                                        href="{{ route('comment', ['id' => $product->id_product]) }}">Xem
                                                        tất
                                                        cả đánh giá</a>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> {{-- container --}}
    </div> {{-- content --}}
@endsection
