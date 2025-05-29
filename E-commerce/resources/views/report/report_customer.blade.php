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

@section('titel', 'Báo cáo khách hàng')

@section('content')
    <div class="admin-content">
        <div class="admin-content-review">
            <div class="admin-content-review-title">
                <h1 class="border-bottom pb-2 mb-4 h5">Thống kê khách hàng mua nhiều nhất</h1>
            </div>
            <div class="admin-content-review-table">
                <div class="admin-content-review-table-list">
                    @if ($topCustomer->isEmpty())
                        <p>Chưa có dữ liệu khách hàng</p>
                    @else
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
                                @foreach ($topCustomer as $customer)
                                    <tr>
                                        <td>{{ $customer->customer_name }}</td>
                                        <td>{{ $customer->customer_email }}</td>
                                        <td>{{ $customer->customer_phone }}</td>
                                        <td>{{ $customer->total_orders }}</td>
                                        <td>{{ $customer->total_amount }} VND</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
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
</script>