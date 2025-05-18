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


    <style>
        table tbody tr {
            border-bottom: 1px solid #e9e9e9;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, .1);
        }

        table tbody tr td {
            padding: 0;
        }
    </style>
    <title>Quản lý đơn hàng</title>
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
                                    <li><a href="{{ route('orders.order_process') }}"><i
                                                class="ri-arrow-right-s-fill"></i>Đơn hàng đang xử lý</a></li>
                                    <li><a href="{{ route('orders.order_cancelled') }}"><i
                                                class="ri-arrow-right-s-fill"></i>Đơn hàng bị hủy</a></li>
                                </div>
                            </ul>
                        </li>
                        <li><a href="{{ route('managerreview') }}"><i class="ri-feedback-line"></i>Quản lý Đánh giá</a></li>
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
                        <h4 class="p-3 m-0">Thống kê khách hàng mua nhiều nhất</h4>
                    </div>
                    <div class="admin-content-review-table">
                        <div class="admin-content-review-table-list">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Tên khách hàng</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Số đơn hàng</th>
                                        <th>Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>user1</td>
                                        <td>user1@gmail.com</td>
                                        <td>123456789</td>
                                        <td>100</td>
                                        <td>100.000.000 VND</td>
                                    </tr>
                                </tbody>
                            </table>

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




    </script>
</body>

</html>