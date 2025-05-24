<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <!-- Style -->
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('/css/orders.css') }}">

    <title>Quản lý đơn hàng</title>

    <style>
        table tbody tr {
            border-bottom: 1px solid #e9e9e9;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, .1);
        }

        table tbody tr td {
            padding: 0;
        }
    </style>
</head>

<body>
    <!-- Start Layout -->
    <section class="admin">
        <div class="row-grid">
            <div class="admin-sidebar">
                <div class="admin-sidebar-top">
                    <div class="avatar-admin">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <div class="name-admin">Admin</div>
                </div>
                <div class="admin-sidebar-content">
                    <ul>
                        <li><a href=""><i class="ri-box-3-line"></i>Quản lý Sản phẩm</a></li>
                        <li><a href=""><i class="fa-solid fa-calendar"></i>Quản lý Đơn hàng<i
                                    class="ri-arrow-down-s-fill"></i></a>
                            <ul class="sub-menu">
                                <div class="sub-menu-items">
                                    <li><a href="{{ route('orders.order_admin') }}"><i
                                                class="ri-arrow-right-s-fill"></i>Xác nhận đơn hàng</a></li>

                                    <li><a href="{{ route('orders.order_cancelled') }}"><i
                                                class="ri-arrow-right-s-fill"></i>Đơn hàng bị hủy</a></li>
                                </div>
                            </ul>
                        </li>

                        <li><a href="{{ route('managerreview') }}"><i class="ri-feedback-line"></i>Quản lý
                                Đánh giá</a></li>

                        <li><a href=""><i class="ri-shield-user-line"></i>Quản lý Người dùng</a></li>
                        <li><a href=""><i class="ri-bar-chart-2-line"></i>Thống kê<i
                                    class="ri-arrow-down-s-fill"></i></a>
                            <ul class="sub-menu">
                                <div class="sub-menu-items">
                                    <li><a href="{{ route('statistic.statistic_money') }}"><i
                                                class="ri-arrow-right-s-fill"></i>Doanh thu</a></li>
                                    <li><a href="{{ route('statistic.statistic_quantity') }}"><i
                                                class="ri-arrow-right-s-fill"></i>Số lượng sản phẩm</a></li>
                                    <li><a href="{{ route('statistic.statistic_product') }}"><i
                                                class="ri-arrow-right-s-fill"></i>Sản phẩm có đánh giá tốt</a></li>
                                </div>
                            </ul>
                        </li>
                        <li><a href=""><i class="ri-file-chart-line"></i>Báo cáo<i class="ri-arrow-down-s-fill"></a></i>
                            <ul class="sub-menu">
                                <div class="sub-menu-items">
                                    <li><a href="{{ route('report.report_product') }}"><i
                                                class="ri-arrow-right-s-fill"></i>Sản phẩm tốt nhất</a></li>
                                    <li><a href="{{ route('report.report_customer') }}"><i
                                                class="ri-arrow-right-s-fill"></i>Top khách hàng</a></li>
                                </div>
                            </ul>
                        </li>
                        <li><a href=""><i class="ri-discount-percent-line"></i>Khuyến mãi</a></li>
                    </ul>
                </div>
            </div>
            <div class="admin-content">
                <div class="admin-content-top">
                    <div class="admin-content-top-left">
                        <ul class="flex-box">
                            <li>
                                <form action="review.php">
                                    <div class="search">
                                        <input type="text" placeholder="Tìm kiếm" class="search-input">
                                        <i class="ri-search-line"></i>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="admin-content-top-right">
                        <ul class="flex-box">
                            <li><i class="fa-solid fa-bell" number="1"></i></li>
                            <li><i class="fa-solid fa-envelope" number="2"></i></li>
                            <li>
                                <i class="fa-solid fa-user-tie"></i>
                                <p>Admin</p>
                                <i style="font-size: 1.3em;" class="ri-arrow-down-s-fill"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="admin-content-review">
                    <div class="admin-content-review-title">
                        <h5 class="p-2">Đơn hàng hủy</h5>
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
                                                <td class="d-flex justify-content-center">
                                                    <form action="{{ route('deleteInvoice', $cancel->invoice_id) }}"
                                                        method="POST" onclick="return confirm('Ban co muon xoa khong?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mx-2">Xóa</button>
                                                    </form>

                                                    <button class="btn btn-success btn-detail"
                                                        data-id="{{ $cancel->invoice_id }}">Xem chi tiết</button>

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
                                                                <div
                                                                    class="action-form d-flex justify-content-between align-items-center">
                                                                    <div class="order-total-money">
                                                                        Tổng tiền:
                                                                        {{ number_format($detail->priceProduct * $detail->invoice_quantity, 0, ',', '.') }}
                                                                        VND
                                                                    </div>
                                                                    <button type="button"
                                                                        class="btn btn-outline-primary mx-1 order-ok">OK</button>
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
            </div>
        </div>
    </section>
    <!-- End Layout -->

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


    </script>
</body>

</html>