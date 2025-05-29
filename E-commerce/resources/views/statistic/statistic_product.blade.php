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

@section('title', 'Sản phẩm tốt nhất')

@section('content')

    <div class="admin-content">
        <div class="admin-content-review">
            <div class="admin-content-review-title">
                <h4 class="border-bottom pb-2 mb-4 h5">Thống kê sản phẩm tốt nhất</h4>
            </div>
            <div class="admin-content-review-table">
                <div class="admin-content-review-table-list">
                    @if ($topProducts->isEmpty())
                        <p>Chưa có đánh giá nào</p>
                        <table>
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Đánh giá trung bình</th>
                                    <th>Số đánh giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topProducts as $product)
                                    <tr>
                                        <td><img style="width: 70px;" src="{{ asset('images/' . $product->product_image_url) }}"
                                                alt=""></td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ number_format($product->product_price, 0, ',', '.') }}</td>
                                        <td>{{ number_format($product->average_rating, 1) }}⭐</td>
                                        <td>{{ $product->total_review }}</td>
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