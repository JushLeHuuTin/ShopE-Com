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

@section('title', 'Doanh thu')

@section('content')
    <div class="admin-content">
        <div class="admin-content-review overflow-hidden">
            <div class="admin-content-review-title">
                <h4 class="border-bottom pb-2 mb-4 h5">Thống kế doanh thu</h4>
            </div>
            <div class="admin-content-review-table">
                <div class="admin-content-review-table-list">
                    <div class="admin-content-container">
                        <form action="{{ route('statistic.statistic_money') }}" method="POST">
                            <div class="admin-select-date row g-3 align-items-center px-2">
                                @csrf
                                <div class="row">
                                    <div class="admin-select-date-left col-md-6">
                                        <label for="form-control">Ngày bắt đầu</label>
                                        <input class="form-control" type="date" id="startDate" name="startDate">
                                    </div>
                                    <div class="admin-select-date-right col-md-6">
                                        <label for="form-control">Ngày kết thúc</label>
                                        <input class="form-control" type="date" id="endDate" name="endDate">
                                    </div>
                                </div>
                            </div>
                            <div class="admin-revenua text-center p-4">
                                <p class=" fs-4">DOANH THU</p>
                                @if (isset($startDate) && isset($endDate))
                                    <img class="revenua" src="{{ asset('/images/money.png') }}" alt=""><br>
                                    <span class="fs-5 m-4">{{ isset($totalRevenue) ? number_format($totalRevenue) : '0' }}
                                        VND</span>
                                    <div class="admin-orders fs-5 m-3">Số đơn hàng:
                                        {{ isset($totalInvoice) ? $totalInvoice : '0' }} đơn
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary px-4">Xem</button>
                                @if(session('error'))
                                    <div id="error-alert"
                                        class="position-fixed top-50 start-50 translate-middle alert alert-danger text-center shadow-lg rounded p-4"
                                        style="z-index: 1050; min-width: 300px;">
                                        <div class="mb-2">
                                            <i class="fas fa-exclamation-triangle fa-2x text-warning mb-2"></i>
                                            <h5 class="mb-2">Thông báo</h5>
                                            <p class="mb-0">{{ session('error') }}</p>
                                        </div>
                                        <button type="button" class="btn btn-outline-dark mt-3 px-4"
                                            onclick="hideErrorAlert()">OK</button>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
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

    function hideErrorAlert() {
        const alertBox = document.getElementById('error-alert');
        if (alertBox) {
            alertBox.style.display = 'none';
        }
    }

</script>