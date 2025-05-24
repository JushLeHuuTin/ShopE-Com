@extends('header')

@section('content')
<div class="content">
        <!-- Giỏ hàng -->
        <div class="content">
            <div class="container mt-4">
                <div class="row">
                    <!-- Giỏ hàng -->
                    <div class="col-md-8">
                        <h5>Giỏ Hàng</h5>
                        <table class="table align-middle">
                            <thead class="cart-header">
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Số tiền</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($carts as $cart)
                                <tr class="cart-item">
                                    <td>
                                        <input type="checkbox" name="selected[]" value="{{ $cart->id_cart }}">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $cart->variant->product->image_url ?? 'https://via.placeholder.com/80' }}"
                                                class="me-2" width="80" height="80" alt="Ảnh sản phẩm">

                                            <div>
                                                <div>{{ $cart->variant->product->name ?? 'Sản phẩm' }}</div>
                                                <small>
                                                    Màu: {{ $cart->variant->color ?? '' }},
                                                    Size: {{ $cart->variant->size ?? '' }}
                                                </small>
                                            </div>

                                        </div>
                                    </td>
                                    <td>{{ number_format($cart->price,0,',','.') }}₫</td>
                                    <td>
                                        <input type="number"
                                            class="form-control text-center quantity-input"
                                            value="{{ $cart->quantity }}"
                                            min="1"
                                            data-cart-id="{{ $cart->id_cart }}"
                                            style="width: 60px;">
                                    </td>
                                    <td class="subtotal" data-cart-id="{{ $cart->id_cart }}">
                                        {{ number_format($cart->price * $cart->quantity, 0, ',', '.') }}₫
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.destroy', $cart->id_cart) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                </svg>
                                            </button>

                                        </form>

                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Giỏ hàng trống.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- Phân trang nếu có --}}
                        {{ $carts->links() }}
                    </div>


                    <!-- Thông tin vận chuyển -->
                    <div class="col-md-4">
                        <h6>Thông tin vận chuyển</h6>
                        <form>
                            <div class="mb-2"><input type="text" class="form-control" placeholder="Họ tên"></div>
                            <div class="mb-2"><input type="text" class="form-control" placeholder="SĐT"></div>
                            <div class="mb-2"><input type="email" class="form-control" placeholder="Email"></div>
                            <div class="mb-2"><input type="text" class="form-control" placeholder="Tỉnh/Thành phố"></div>
                            <div class="mb-2"><input type="text" class="form-control" placeholder="Địa chỉ cụ thể"></div>
                            <button type="button" class="btn btn-secondary mb-3">Lưu</button>

                            <p><strong>Tổng:</strong></p>
                            <div class="mb-2"><input type="text" class="form-control" placeholder="Mã giảm giá"></div>
                            <button type="submit" class="btn btn-primary">Thanh toán</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection