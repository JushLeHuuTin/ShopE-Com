<div class="w-1/5 bg-white h-screen p-4">
    <div class="flex items-center mb-6">
     <img alt="User avatar" class="rounded-full" height="50" src="https://storage.googleapis.com/a1aa/image/h68SfOi0HcbSpoV3jRIwqaVWa-pL3o6LmhtU7v5vBUQ.jpg" width="50"/>
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
            <li><a href="{{ route('product.add') }}" class="text-sm text-gray-700 hover:text-green-600">➕ Thêm sản phẩm</a></li>
            <li><a href="{{ route('product.list') }}" class="text-sm text-gray-700 hover:text-green-600">📋 Danh sách sản phẩm</a></li>
            <li><a href="{{ route('product.deleted') }}" class="text-sm text-gray-700 hover:text-green-600">🗑️ Sản phẩm đã xoá</a></li>
        </ul>
        
     <li class="flex items-center">
      <i class="fas fa-shopping-cart mr-2">
      </i>
      <span>
       Quản lý Đơn hàng
      </span>
     </li>
       
     <li class="flex items-center">
      <i class="fas fa-star mr-2">
      </i>
      <span>
       Quản lý Đánh giá
      </span>
     </li>
     <li class="flex items-center">
      <i class="fas fa-user mr-2">
      </i>
      <span>
       Quản lý Người dùng
      </span>
     </li>
     <li class="flex items-center">
      <i class="fas fa-chart-bar mr-2">
      </i>
      <span>
       Thống kê
      </span>
     </li>
     <li class="flex items-center">
      <i class="fas fa-file-alt mr-2">
      </i>
      <span>
       Báo cáo
      </span>
     </li>
     <li class="flex items-center">
      <i class="fas fa-tags mr-2">
      </i>
      <span>
       Khuyến mãi
      </span>
     </li>
     {{-- text-green-500 --}}
     <li class="flex items-center "onClick=toggleMenu("voucher")>
      <i class="fas fa-ticket-alt mr-2" >
      </i>
      Voucher

     </li>
       <ul id="voucher" class="ml-6 mt-2 space-y-2 hidden">
            <li><a href="{{ route('voucher.add') }}" class="text-sm text-gray-700 hover:text-green-600">➕ Thêm mã giảm giá</a></li>
            <li><a href="{{ route('voucher.list') }}" class="text-sm text-gray-700 hover:text-green-600">📋 Danh sách mã giảm giá </a></li>
        </ul>
    </ul>
   </div>