@php
    use Carbon\Carbon;
@endphp

<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Voucher Management
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 </head>
 <body class="bg-gray-100">
  <div class="flex">
   <!-- Sidebar -->
   <div class="w-1/5 bg-white h-screen p-4">
    <div class="flex items-center mb-6">
     <img alt="User avatar" class="rounded-full" height="50" src="https://storage.googleapis.com/a1aa/image/h68SfOi0HcbSpoV3jRIwqaVWa-pL3o6LmhtU7v5vBUQ.jpg" width="50"/>
     <span class="ml-2">
      Name
     </span>
    </div>
    <ul class="space-y-4">
     <li class="flex items-center">
      <i class="fas fa-box mr-2">
      </i>
      <span>
       Quản lý Sản phẩm
      </span>
     </li>
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
     <li class="flex items-center text-green-500">
      <i class="fas fa-ticket-alt mr-2">
      </i>
      <span>
       Voucher
      </span>
     </li>
    </ul>
   </div>
   <!-- Main Content -->
   <div class="w-4/5 p-6">
    <div class="flex justify-between items-center mb-6">
     <div class="flex items-center space-x-4">
      <i class="fas fa-bell">
      </i>
      <i class="fas fa-envelope">
      </i>
      <div class="flex items-center">
       <img alt="User avatar" class="rounded-full" height="30" src="https://storage.googleapis.com/a1aa/image/h68SfOi0HcbSpoV3jRIwqaVWa-pL3o6LmhtU7v5vBUQ.jpg" width="30"/>
       <span class="ml-2">
        Name
       </span>
       <i class="fas fa-caret-down ml-1">
       </i>
      </div>
     </div>
     <div>
      <input class="border rounded p-2" placeholder="Tìm kiếm..." type="text"/>
     </div>
    </div>
    <h2 class="text-xl font-bold mb-4">
     Danh sách mã giảm giá
    </h2>
    <table class="w-full bg-white rounded shadow">
     <thead>
      <tr class="bg-green-500 text-white">
       <th class="p-2">
        Mã giảm giá
       </th>
       <th class="p-2">
        Phần trăm giảm
       </th>
       <th class="p-2">
        Ngày kết thúc
       </th>
       <th class="p-2">
        Trạng thái
       </th>
       <th class="p-2">
        Số lần sử dụng
       </th>
       <th class="p-2">
        Hành động
       </th>
      </tr>
     </thead>
     <tbody>
     @forelse($vouchers as $voucher) 
      <tr class="border-b">
       <td class="p-2">
        {{ $voucher->code }}
       </td>
       <td class="p-2">
       {{ $voucher->discount_value }}
       %
        
       </td>
       <td class="p-2">
       {{ $voucher->expiration_date }}
        
       </td>
       <td class="p-2">
        <span class="bg-green-500 text-white rounded px-2 py-1">
        @if (Carbon::parse($voucher->expiration_date)->isFuture())
            <span class="">Còn hạn</span>
        @else
            <span class="">Hết hạn</span>
        @endif
         
        </span>
       </td>
       <td class="p-2">
        20
       </td>
       <td class="p-2 flex space-x-2">
        <i class="fas fa-pen text-red-500 cursor-pointer">
        </i>
        <i class="fas fa-trash text-red-500 cursor-pointer">
        </i>
       </td>
      </tr>
      @empty
                    <p>Không có mã giảm giá.</p>
                @endforelse


 
     </tbody>
    </table>
   </div>
  </div>
 </body>
</html>
