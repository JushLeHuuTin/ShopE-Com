<link rel="stylesheet" href="{{ asset('/css/orders.css') }}">

<style>
    table tbody tr {
        border-bottom: 1px solid #e9e9e9;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, .1);
    }

    table tbody tr td {
        padding: 0;
    }
</style>


@extends('layout.admin')
@section('title', 'Quản lý Đơn Hàng Hủy')
@section('content')
<div class="admin-content">
    <div class="admin-content-review">
        <div class="admin-content-review-title">
            <h5 class="border-bottom pb-2 mb-4 h5">Đơn hàng hủy</h5>
        </div>
        <div class="admin-content-review-table">
            <div class="admin-content-review-table-list">
                @if ($cancellInvoice->isEmpty())
                    <p class="d-flex justify-content-center">Chua co du lieu hoa don</p>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Lý do hủy</th>
                                <th>Ngày hủy</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cancellInvoice as $cancel)
                                <tr>
                                    <td>{{ $cancel->invoice_id }}</td>
                                    <td>{{ $cancel->customer_name }}</td>
                                    <td>{{ $cancel->cancellation_reason }}</td>
                                    <td>{{ $cancel->date_cancel }}</td>
                                    <td>{{ $cancel->status_cancelled }}</td>
                                    <td>
                                        <form action="{{ route('deleteInvoice', $cancel->invoice_id) }}" method="POST"
                                            onclick="confirm('Ban co muon xoa khong?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Xóa</button>
                                            <button class="btn btn-success btn-detail" data-id="{{ $cancel->invoice_id }}">Xem
                                                chi tiết</button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- End Form chi tiet don hang -->
                                <div class="form-orders-detail" id="form-detail-{{ $cancel->invoice_id }}"
                                    data-id="{{ $cancel->invoice_id }}" style="display: none">
                                    <div class="wapper-orders">
                                        <div class="form-order-title p-1">
                                            <div class="order-text mt-2">Chi tiết đơn hàng</div>
                                            <p class="order-close mt-2" data-id="{{ $cancel->invoice_id }}">X</p>
                                        </div>
                                        @if(isset($invoicesDetail[$cancel->invoice_id]))
                                            @foreach ($invoicesDetail[$cancel->invoice_id] as $detail)
                                                <div class="form-order-product">
                                                    <div class="form-order-product-detail">
                                                        <img style="width: 150px;"
                                                            src="{{ asset('images/' . $detail->product_image_url)  }}"
                                                            alt="{{ $detail->product_name }}">
                                                        <div class="order-content">
                                                            <div class="order-name">{{ $detail->product_name }}</div>
                                                            <div class="order-price">
                                                                {{ number_format($detail->priceProduct, 0, ',', '.') }} VND
                                                            </div>
                                                        </div>
                                                        <div class="order-quantity">SL: {{ $detail->invoice_quantity }}
                                                        </div>
                                                    </div>
                                                    <div class="action-form d-flex justify-content-between align-items-center">
                                                        <div class="order-total-money">
                                                            Tổng tiền:
                                                            {{ number_format($detail->priceProduct * $detail->invoice_quantity, 0, ',', '.') }}
                                                            VND
                                                        </div>
                                                        <button type="button" class="btn btn-outline-primary mx-1 order-ok">OK</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <!-- Form chi tiet don hang -->
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $cancellInvoice->links('pagination::bootstrap-5') }}
                    </div>

                @endif
            </div>
        </div>
    </div>
    </section>
    <!-- End Layout -->
    <div class="status-container" style="display: none">
        <div class="status-infor d-block text-center">
            <div class="status-title">Thông báo</div>
            <p class="mt-4" id="statusMessageText"></p>
            <button type="button" class="btn btn-outline-primary btn-status">OK</button>
        </div>
    </div>



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

        document.querySelectorAll('.btn-detail').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const detailRow = document.getElementById('form-detail-' + id);
                if (detailRow) {
                    detailRow.style.display = detailRow.style.display === 'none' ? '' : 'none';
                }
            });
        });

        document.querySelectorAll('.order-close').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const detailRow = document.getElementById('form-detail-' + id);
                if (detailRow) {
                    detailRow.style.display = 'none';
                }
            });
        });

        document.querySelectorAll('.order-ok').forEach(button => {
            button.addEventListener('click', function () {
                const detailWrapper = this.closest('.form-orders-detail');
                if (detailWrapper) {
                    detailWrapper.style.display = 'none';
                }
            });
        });

        // Lấy thông báo từ session
        @if (session('message'))
            formStatus.style.display = 'block';
            messageText.innerText = "{{ session('message') }}";
        @endif

        @if (session('error'))
            formStatus.style.display = 'block';
            messageText.innerText = "{{ session('error') }}";
            formStatus.style.backgroundColor = '#f8d7da'; // màu đỏ cho lỗi
        @endif

        // Xử lý nút OK
        btnStatus?.addEventListener('click', () => {
            formStatus.style.display = 'none';
        });

    </script>