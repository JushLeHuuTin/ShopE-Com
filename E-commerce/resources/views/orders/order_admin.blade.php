<link rel="stylesheet" href="{{ asset('/css/orders.css') }}">

<style>
    table tbody tr {
        border-bottom: 1px solid #e9e9e9;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, .1);
    }

    table tbody tr td {
        padding: 0;
    }

    .form-orders-detail {
        animation: form 1s both;
    }

    @keyframes form {
        0% {
            transform: scale(2) translate(-50%, -40%);
            opacity: 0;
        }

        100% {
            transform: scale(1) translate(-50%, -40%);
            opacity: 1;
        }

    }
</style>

@extends('layout.admin')
@section('title', 'Quản lý Đơn hàng')
@section('content')
    <div class="admin-content">
        <div class="admin-content-review">
            <div class="admin-content-review-title">
                <h1 class="border-bottom pb-2 mb-4 h5">Quản lý đơn hàng</h1>
            </div>
            <div class="admin-content-review-table">
                <div class="admin-content-review-table-list">
                    @if ($processInvoices->isEmpty())
                        <p class="d-flex justify-content-center">Chưa có dữ liệu hóa đơn</p>
                    @else
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Ngày tạo</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            @foreach ($processInvoices as $processInvoice)
                                <tbody>
                                    <tr>
                                        <td>{{ $processInvoice->invoice_id }}</td>
                                        <td>{{ $processInvoice->customer_name }}</td>
                                        <td>{{ $processInvoice->dateOrder }}</td>
                                        <td>{{ number_format($processInvoice->total_money, 0, ',', '.') }}</td>
                                        <td>{{ $processInvoice->status }}</td>
                                        <td>
                                            <button class="btn-order">Xác nhận</button>
                                            <button class="btn-order-detail" data-id="{{ $processInvoice->invoice_id }}">Xem chi
                                                tiết</button>
                                        </td>
                                    </tr>
                                    <div class="form-orders-detail" id="form-detail-{{ $processInvoice->invoice_id }}"
                                        data-id="{{ $processInvoice->invoice_id }}" style="display: none;">
                                        <div class="wapper-orders">
                                            <div class="form-order-title p-1">
                                                <div class="order-text mt-2">Chi tiết đơn hàng</div>
                                                <p class="order-close mt-2" data-id="{{ $processInvoice->invoice_id }}">
                                                    X</p>
                                            </div>
                                            <div class="form-order-product">
                                                @foreach ($invoicesDetail[$processInvoice->invoice_id] ?? [] as $detail)
                                                    <div class="form-order-product-detail">
                                                        <img style="width: 150px;"
                                                            src="{{ asset('images/' . $detail->product_image_url) }}" alt="">
                                                        <div class="order-content">
                                                            <div class="order-name">{{ $detail->product_name }}</div>
                                                            <div class="order-price">
                                                                {{ number_format($detail->priceProduct, 0, ',', '.') }} VND
                                                            </div>
                                                        </div>
                                                        <div class="order-quantity">SL: {{ $detail->invoice_quantity }}
                                                        </div>
                                                    </div>

                                                @endforeach
                                                <div class="action-form d-flex justify-content-between  align-items-center">
                                                    <div class="order-total-money">Tổng tiền:
                                                        {{ number_format($processInvoice->total_money, 0, ',', '.') }}
                                                        VND
                                                    </div>
                                                    <button type="button" class="btn btn-outline-primary mx-1 order-ok">OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Form chi tiet don hang -->
                                </tbody>
                            @endforeach

                        </table>
                        <div class="mt-2">
                            {{ $processInvoices->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                    <!-- Form chi tiet don hang -->
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    const menuLi = document.querySelectorAll('.admin-sidebar-content > ul > li > a');
    const submenu = document.querySelectorAll('.sub-menu');

    menuLi.forEach(link => {
        link.addEventListener('click', (e) => {
            const currentSubMenu = link.parentElement.querySelector('.sub-menu');

            // Chỉ xử lý nếu có submenu
            if (currentSubMenu) {
                e.preventDefault();

                const isActive = currentSubMenu.classList.contains('active');

                submenu.forEach(menu => {
                    menu.classList.remove('active');
                    menu.style.height = '0px';
                });

                if (!isActive) {
                    currentSubMenu.classList.add('active');
                    const submenuHeight = currentSubMenu.querySelector('.sub-menu-items').offsetHeight;
                    currentSubMenu.style.height = submenuHeight + 'px';
                }
            }
        });
    });

    document.querySelectorAll('.btn-order-detail').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const form = document.getElementById('form-detail-' + id);
            if (form) form.style.display = 'block';
        });
    });

    document.querySelectorAll('.order-close, .order-ok').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('.form-orders-detail');
            if (form) {
                form.style.display = 'none';
            }
        });
    });

</script>