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
                        <form id="checkout-form" action="{{ route('checkout.show') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

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
                                        <img src="{{ 'images/' .$cart->variant->product->image_url 
                                            ? asset('images/' .$cart->variant->product->image_url)
                                            : 'https://via.placeholder.com/80' }}"
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
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('shipping.save') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <input type="text" class="form-control" name="full_name" placeholder="Họ tên"
                                value="{{ $shipping->full_name ?? '' }}">
                        </div>
                        <div class="mb-2">
                            <input type="text" class="form-control" name="phone" placeholder="SĐT"
                                value="{{ $shipping->phone ?? '' }}">
                        </div>
                        <div class="mb-2">
                            <input type="email" class="form-control" value="{{ $shipping->user->email ?? '' }}" placeholder="Email" disabled>
                        </div>
                        <div class="mb-2">
                            <input type="text" class="form-control" name="address" placeholder="Địa chỉ cụ thể"
                                value="{{ $shipping->address ?? '' }}">
                        </div>
                        <button type="submit" class="btn btn-secondary mb-3">Lưu</button>
                    </form>
                    <!-- Tổng tiền cần thanh toán -->
                    <p><strong>Tổng:</strong> <span id="total-price" class="fw-bold"></span></p>
                    <p>
                        <strong>Sau giảm :</strong>
                        <span id="original-total" style="text-decoration: line-through; color: gray;"></span>
                        <span id="discounted-total" class="fw-bold text-danger"></span>
                        <!-- <br>
                        <strong>Giá sau giảm:</strong>
                        <span id="discounted-total" class="fw-bold text-danger"></span> -->
                    </p>

                    <!-- Mã giảm giá -->
                    <div class="mb-2">
                        <form id="apply-discount-form" class="mb-2">
                            <div class="input-group">
                                <input type="text" class="form-control" id="discount-code" placeholder="Mã giảm giá">
                                <button type="submit" class="btn btn-success">Áp dụng</button>
                            </div>
                            <div id="discount-message" class="mt-1 text-danger"></div>
                        </form>
                    </div>

                    
                    <form id="checkout-form" action="{{ route('checkout.show') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button type="button" class="btn btn-primary" id="proceed-checkout">Thanh toán</button>
                    

                    <br>
                    <form action="{{ route('invoices.index') }}" method="GET">
                        <button type="submit" class="btn btn-success">Theo dõi đơn hàng</button>
                    </form>


                </div>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý sự kiện thay đổi số lượng
            document.querySelectorAll('.quantity-input').forEach(function(input) {
                input.addEventListener('change', function() {
                    const cartId = this.dataset.cartId;
                    const quantity = parseInt(this.value);

                    if (quantity < 1) {
                        alert("Số lượng tối thiểu là 1");
                        this.value = 1;
                        return;
                    }

                    fetch("{{ route('cart.updateQuantity') }}", {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                id_cart: cartId,
                                quantity: quantity
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const subtotalTd = document.querySelector(`.subtotal[data-cart-id="${cartId}"]`);
                                subtotalTd.textContent = data.subtotal + '₫';
                                updateTotalPrice(); // cập nhật tổng tiền sau khi thay đổi số lượng
                            } else {
                                alert('Lỗi cập nhật giỏ hàng!');
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi:', error);
                        });
                });
            });

            // Xử lý sự kiện checkbox chọn sản phẩm
            document.querySelectorAll('input[name="selected[]"]').forEach(function(checkbox) {
                checkbox.addEventListener('change', updateTotalPrice);
            });

            // Xử lý "select all"
            const selectAllCheckbox = document.getElementById('select-all');
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    const isChecked = this.checked;
                    document.querySelectorAll('input[name="selected[]"]').forEach(cb => cb.checked = isChecked);
                    updateTotalPrice();
                });
            }

            // Hàm cập nhật tổng tiền
            function updateTotalPrice() {
                let total = 0;

                document.querySelectorAll('.cart-item').forEach(function(row) {
                    const checkbox = row.querySelector('input[type="checkbox"]');
                    const subtotalText = row.querySelector('.subtotal')?.textContent || '0';

                    if (checkbox && checkbox.checked) {
                        let raw = subtotalText.replace(/[₫.]/g, '').trim();
                        total += parseInt(raw);
                    }
                });

                document.getElementById('total-price').textContent = total.toLocaleString('vi-VN') + '₫';
            }

            // Hàm format tiền
            function formatCurrency(amount) {
                return amount.toLocaleString('vi-VN') + '₫';
            }

            // Áp dụng mã giảm giá
            const applyDiscountForm = document.getElementById('apply-discount-form');
            if (applyDiscountForm) {
                applyDiscountForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const code = document.getElementById('discount-code').value.trim();

                    fetch('{{ route("cart.applyDiscount") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                code
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            const messageDiv = document.getElementById('discount-message');
                            if (!data.success) {
                                messageDiv.textContent = data.message;
                                return;
                            }

                            messageDiv.textContent = '';

                            // Tính tổng từ các sản phẩm được chọn
                            let total = 0;
                            document.querySelectorAll('.cart-item').forEach(function(row) {
                                const checkbox = row.querySelector('input[type="checkbox"]');
                                const subtotalText = row.querySelector('.subtotal')?.textContent || '0';

                                if (checkbox && checkbox.checked) {
                                    let raw = subtotalText.replace(/[₫.]/g, '').trim();
                                    total += parseInt(raw);
                                }
                            });

                            const discountedTotal = total - data.discount_value;

                            document.getElementById('original-total').textContent = formatCurrency(total);
                            document.getElementById('discounted-total').textContent = formatCurrency(discountedTotal);
                        })
                        .catch(err => {
                            console.error(err);
                            document.getElementById('discount-message').textContent = 'Đã xảy ra lỗi khi áp dụng mã.';
                        });
                });
            }

            updateTotalPrice();

            // Xử lý nút "Thanh toán"
            document.getElementById('proceed-checkout').addEventListener('click', function() {
                const selected = document.querySelectorAll('input[name="selected[]"]:checked');
                const form = document.getElementById('checkout-form');
                // Xóa input cũ nếu có
                form.querySelectorAll('input[name="selected[]"]').forEach(input => input.remove());
                if (selected.length === 0) {
                    alert('Vui lòng chọn ít nhất 1 sản phẩm để thanh toán.');
                    return;
                }
                selected.forEach(cb => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'selected[]';
                    input.value = cb.value; // giá trị là id_cart
                    form.appendChild(input);
                });
                form.submit(); // Gửi form sang checkout
            });
        });
    </script>

    @endsection