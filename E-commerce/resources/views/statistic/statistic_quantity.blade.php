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

@section('title', 'Số lượng sản phẩm')
@section('content')

    <div class="admin-content">
        <div class="admin-content-review">
            <div class="admin-content-review-title">
                <h4 class="border-bottom pb-2 mb-4 h5">Thống kê số lượng sản phẩm</h4>
            </div>
            <div class="admin-content-review-table">
                <div class="admin-content-review-table-list">
                    @if ($quantitySell->isEmpty())
                        <p>Chưa có dữ liệu sản phẩm</p>
                    @else
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Danh mục</th>
                                    <th>Số lượng bán</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quantitySell as $quantity)
                                    <tr>
                                        <td>{{ $quantity->product_id }}</td>
                                        <td>{{ $quantity->product_name }}</td>
                                        <td><img style="width: 50px;" src="{{ asset('images/' . $quantity->product_image_url) }}"
                                                alt=""></td>
                                        <td>{{ $quantity->category_name }}</td>
                                        <td>{{ $quantity->total_quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $quantitySell->links('pagination::bootstrap-5') }}
                        </div>
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