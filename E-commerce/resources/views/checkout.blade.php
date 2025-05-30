@extends('dashboard')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Thanh toán đơn hàng</h4>

    <form action="{{ route('checkout.placeOrder') }}" method="POST" id="checkout-form">
        @csrf

        <!-- Địa chỉ nhận hàng -->
        <div class="p-3 bg-light border rounded d-flex justify-content-between align-items-center mb-4">
            <div>
                <i class="bi bi-geo-alt-fill me-2"></i>
                <strong>Địa chỉ nhận hàng:</strong>
                {{ $shippingAddress->address ?? 'Chưa có địa chỉ giao hàng' }} - {{ $shippingAddress->phone }}
            </div>

            @if(isset($shippingAddress->id))
            <input type="hidden" name="shipping_address_id" value="{{ $shippingAddress->id }}">
            @endif
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="p-3 bg-white border rounded mb-4">
            <h5 class="mb-3">Sản phẩm trong giỏ</h5>
            @forelse ($cartItems as $item)
            <div class="row align-items-center mb-3">
                <div class="col-md-2 text-center">
                    <img src="{{ $item->variant->product->image }}" alt="{{ $item->variant->product->name }}" class="img-fluid rounded border">
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-5 fw-semibold">
                            {{ $item->variant->product->name }}
                        </div>
                        <div class="col-md-2 text-muted">
                            {{ number_format($item->variant->price, 0, ',', '.') }}đ
                        </div>
                        <div class="col-md-2">
                            x{{ $item->quantity }}
                        </div>
                        <div class="col-md-3 fw-bold text-danger">
                            {{ number_format($item->variant->price * $item->quantity, 0, ',', '.') }}đ
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center text-muted">Giỏ hàng của bạn đang trống.</div>
            @endforelse
        </div>

        <!-- Ghi chú và Tổng tiền -->
        <div class="row mb-4">
            <!-- Ghi chú đơn hàng -->
            <div class="col-md-6">
                <div class="p-3 bg-white border rounded h-100">
                    <label for="ghichu" class="form-label">Ghi chú đơn hàng</label>
                    <textarea class="form-control" name="ghichu" id="ghichu" rows="5"
                        placeholder="Ví dụ: Giao hàng buổi sáng, gọi trước khi giao..."></textarea>
                </div>
            </div>

            <!-- Mã giảm giá + Tổng thanh toán -->
            <div class="col-md-6">
                <div class="p-3 bg-white border rounded">
                    <!-- Mã giảm giá -->
                    <div class="mb-2">
                        <label for="discount-code" class="form-label">Mã giảm giá</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="discount-code" name="coupon_code" placeholder="Nhập mã nếu có">
                            <button type="button" class="btn btn-success" id="apply-discount-btn">Áp dụng</button>
                        </div>
                        <div id="discount-message" class="mt-1 text-danger"></div>
                    </div>

                    <hr>

                    <!-- Tạm tính -->
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tạm tính</span>
                        <span id="cart-subtotal">{{ number_format($total ?? 0, 0, ',', '.') }}₫</span>
                    </div>

                    <!-- Phí vận chuyển -->
                    <div class="d-flex justify-content-between mb-2">
                        <span>Phí vận chuyển</span>
                        <span id="shipping-fee">30.000₫</span>
                    </div>

                    <!-- Giá sau giảm nếu có -->
                    <div class="d-flex justify-content-between mb-2" id="discount-line" style="display: none;">
                        <span>Giảm giá</span>
                        <span id="discount-amount" class="text-success"></span>
                    </div>

                    <!-- Tổng thanh toán -->
                    <div class="d-flex justify-content-between border-top pt-2">
                        <span class="fw-bold">Tổng thanh toán</span>
                        <span id="final-total" class="fw-bold text-danger">
                            {{ number_format(($total ?? 0) + 30000, 0, ',', '.') }}₫
                        </span>
                    </div>

                    <!-- Hidden input để submit -->
                    <input type="hidden" name="tong_thanhtoan" id="tong_thanhtoan" value="{{ ($total ?? 0) + 30000 }}">
                </div>
            </div>
        </div>

        <!-- Phương thức thanh toán và nút Đặt hàng -->
        <div class="p-3 bg-white border rounded d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="w-100 w-md-50 mb-3 mb-md-0">
                <label for="payment" class="form-label">Phương thức thanh toán</label>
                <select class="form-select" name="payment" id="payment">
                    <option value="cod" selected>Thanh toán khi nhận hàng</option>
                    <option value="bank">Chuyển khoản ngân hàng</option>
                    <option value="card">Thẻ tín dụng</option>
                </select>
            </div>
            <div class="text-end w-100 w-md-auto">
                <button type="submit" class="btn btn-primary px-4 py-2 mt-3 mt-md-0">Đặt hàng</button>
            </div>
            <form action="{{ route('checkout.placeOrder') }}" method="POST">
                @csrf

                {{-- Gửi danh sách id_cart đã chọn --}}
                @foreach ($cartItems as $item)
                <input type="hidden" name="selected[]" value="{{ $item->id_cart }}">
                @endforeach

                {{-- Gửi tổng thanh toán và phương thức thanh toán --}}
                <input type="hidden" name="tong_thanhtoan" value="{{ $total }}">
                <input type="hidden" name="payment_method" value="COD">

                <button type="submit">Đặt hàng</button>
            </form>

        </div>
    </form>
</div>

<script>
    window.addEventListener('beforeunload', function() {
        navigator.sendBeacon("{{ route('checkout.clear_session') }}");
    });

    function updateTotalAfterDiscount(discountValue = 0) {
        const subtotalText = document.getElementById('cart-subtotal')?.textContent?.replace(/[₫.]/g, '') || '0';
        const shippingFee = 30000;

        let subtotal = parseInt(subtotalText);
        let total = subtotal + shippingFee - discountValue;

        // Cập nhật giao diện
        document.getElementById('discount-line').style.display = discountValue > 0 ? 'flex' : 'none';
        document.getElementById('discount-amount').textContent = '- ' + discountValue.toLocaleString('vi-VN') + '₫';
        document.getElementById('final-total').textContent = total.toLocaleString('vi-VN') + '₫';
        document.getElementById('tong_thanhtoan').value = total;
    }

    document.getElementById('apply-discount-btn').addEventListener('click', function() {
        const couponCode = document.getElementById('discount-code').value.trim();
        const discountMessage = document.getElementById('discount-message');

        if (!couponCode) {
            discountMessage.textContent = 'Vui lòng nhập mã giảm giá.';
            discountMessage.classList.remove('text-success');
            discountMessage.classList.add('text-danger');
            updateTotalAfterDiscount(0);
            return;
        }

        fetch('{{ route("checkout.applyDiscount") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    coupon_code: couponCode
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.valid) {
                    updateTotalAfterDiscount(data.discountAmount);
                    discountMessage.textContent = 'Mã giảm giá áp dụng thành công!';
                    discountMessage.classList.remove('text-danger');
                    discountMessage.classList.add('text-success');
                } else {
                    discountMessage.textContent = data.message || 'Mã giảm giá không hợp lệ.';
                    discountMessage.classList.remove('text-success');
                    discountMessage.classList.add('text-danger');
                    updateTotalAfterDiscount(0);
                }
            })
            .catch(() => {
                discountMessage.textContent = 'Lỗi kết nối, vui lòng thử lại.';
                discountMessage.classList.remove('text-success');
                discountMessage.classList.add('text-danger');
            });
    });
</script>
@endsection