<div class="w-1/5 bg-white h-screen p-4">
    <div class="flex items-center mb-6">
        <img alt="User avatar" class="rounded-full" height="50"
            src="https://storage.googleapis.com/a1aa/image/h68SfOi0HcbSpoV3jRIwqaVWa-pL3o6LmhtU7v5vBUQ.jpg"
            width="50" />
        <span class="ml-2">
            Name
        </span>
    </div>
    <ul class="space-y-4">
        <li class="flex items-center cursor-pointer" onclick="toggleMenu('productMenu')">
            <i class="fas fa-box mr-2"></i>
            <span>Quản lý Sản phẩm</span>
        </li>
        <ul id="productMenu" class="ml-6 mt-2 space-y-2 hidden">
            <li><a href="{{ route('product.add') }}" class="text-sm text-gray-700 hover:text-green-600">➕ Thêm sản
                    phẩm</a></li>
            <li><a href="{{ route('product.list') }}" class="text-sm text-gray-700 hover:text-green-600">📋 Danh sách
                    sản phẩm</a></li>
            <li><a href="{{ route('product.deleted') }}" class="text-sm text-gray-700 hover:text-green-600">🗑️ Sản phẩm
                    đã xoá</a></li>
        </ul>

        <li class="flex items-center cursor-pointer" onclick="toggleMenu('invoiceMenu')">
            <i class="fas fa-shopping-cart mr-2">
            </i>
            <span>
                Quản lý Đơn hàng
            </span>
        </li>
        <ul id="invoiceMenu" class="ml-6 mt-2 space-y-2 hidden">
            <li><a href="{{ route('orders.order_admin') }}" class="text-sm text-gray-700 hover:text-green-600">➕ Xác
                    nhận đơn hàng</a></li>
            <li><a href="{{ route('orders.order_cancelled') }}" class="text-sm text-gray-700 hover:text-green-600">📋
                    Đơn hàng bị hủy</a></li>
        </ul>

        <li class="flex items-center">
            <a href="{{ route('managerreview') }}"><i class="fas fa-star mr-2"></i><span>Quản lý Đánh giá</span></a>
        </li>
        <li class="flex items-center">
            <i class="fas fa-user mr-2">
            </i>
            <span>
                Quản lý Người dùng
            </span>
        </li>
        <li class="flex items-center cursor-pointer" onclick="toggleMenu('statisticMenu')">
            <i class="fas fa-chart-bar mr-2">
            </i>
            <span>
                Thống kê
            </span>
        </li>
        <ul id="statisticMenu" class="ml-6 mt-2 space-y-2 hidden">
            <li><a href="{{ route('statistic.statistic_money') }}" class="text-sm text-gray-700 hover:text-green-600">Doanh thu</a></li>
            <li><a href="{{ route('statistic.statistic_quantity') }}" class="text-sm text-gray-700 hover:text-green-600">Số lượng sản phẩm</a></li>
            <li><a href="{{ route('statistic.statistic_product') }}" class="text-sm text-gray-700 hover:text-green-600">Sản phẩm có đánh giá tốt</a></li>
        </ul>

        <li class="flex items-center cursor-pointer" onclick="toggleMenu('reportMenu')">
            <i class="fas fa-file-alt mr-2">
            </i>
            <span>
                Báo cáo
            </span>
        </li>
        <ul id="reportMenu" class="ml-6 mt-2 space-y-2 hidden" >
            <li><a href="{{ route('report.report_product') }}" class="text-sm text-gray-700 hover:text-green-600">Sản phẩm tốt nhất</a></li>
            <li><a href="{{ route('report.report_customer') }}" class="text-sm text-gray-700 hover:text-green-600">Top khách hàng</a></li>
        </ul>
        <li class="flex items-center " onclick="{toggleMenu('promotion')}">
            <i class="fas fa-tags mr-2">
            </i>
            <span>
                Khuyến mãi
            </span>
        </li>
        <ul id="promotion" class="ml-6 mt-2 space-y-2 hidden">
            <li><a href="{{ route('promotion.add') }}" class="text-sm text-gray-700 hover:text-green-600">➕ Thêm mã
                    chương trình khuyến mãi</a></li>
            <li><a href="{{ route('promotion.list') }}" class="text-sm text-gray-700 hover:text-green-600">📋 Danh sách
                    chương trình khuyến mãi</a></li>
        </ul>
        {{-- text-green-500 --}}
        <li class="flex items-center " onclick="{toggleMenu('voucher')}">
            <i class="fas fa-ticket-alt mr-2">
            </i>
            Voucher

        </li>
        <ul id="voucher" class="ml-6 mt-2 space-y-2 hidden">
            <li><a href="{{ route('voucher.add') }}" class="text-sm text-gray-700 hover:text-green-600">➕ Thêm mã giảm
                    giá</a></li>
            <li><a href="{{ route('voucher.list') }}" class="text-sm text-gray-700 hover:text-green-600">📋 Danh sách mã
                    giảm giá </a></li>
        </ul>
    </ul>
</div>