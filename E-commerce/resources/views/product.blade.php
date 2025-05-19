<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Dashboard
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-1/5 bg-white border-r">
            <div class="p-4">
                <div class="text-lg font-bold mb-4">
                    Name
                </div>
                <div class="mb-4">
                    <input class="w-full p-2 border rounded" placeholder="Tìm kiếm..." type="text" />
                </div>
                <div class="space-y-2">
                    <div class="font-bold">
                        Quản lý
                    </div>
                    <div class="pl-4 space-y-1">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-box">
                            </i>
                            <span>
                                Quản lý Sản phẩm
                            </span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-shopping-cart">
                            </i>
                            <span>
                                Quản lý Đơn hàng
                            </span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-star">
                            </i>
                            <span>
                                Quản lý Đánh giá
                            </span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-users">
                            </i>
                            <span>
                                Quản lý Người dùng
                            </span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-tags">
                            </i>
                            <span>
                                Khuyến mãi
                            </span>
                        </div>
                    </div>
                    <div class="font-bold">
                        Thống kê
                    </div>
                    <div class="pl-4 space-y-1">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-chart-bar">
                            </i>
                            <span>
                                Báo cáo
                            </span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-exclamation-circle">
                            </i>
                            <span>
                                Đơn hàng chờ xử lý
                            </span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-archive">
                            </i>
                            <span>
                                Đơn hàng bị hủy
                            </span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-fire">
                            </i>
                            <span>
                                Sản phẩm bán chạy
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <div class="flex justify-between items-center mb-4">
                <div class="text-lg font-bold">
                    Dashboard
                </div>
                <div class="flex items-center space-x-4">
                    <i class="fas fa-envelope">
                    </i>
                    <i class="fas fa-bell">
                    </i>
                    <span>
                        Namcy
                    </span>
                </div>
            </div>
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                Xóa thành công
            </div>
            <div class="flex justify-between items-center mb-4">
                <div class="text-lg font-bold">
                    Dashboard
                </div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded">
                    Thêm mới
                </button>
            </div>
            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 px-4 text-left">
                            ID
                        </th>
                        <th class="py-2 px-4 text-left">
                            Tên sản phẩm
                        </th>
                        <th class="py-2 px-4 text-left">
                            Giá
                        </th>
                        <th class="py-2 px-4 text-left">
                            Danh mục
                        </th>
                        <th class="py-2 px-4 text-left">
                            Hình ảnh
                        </th>
                        <th class="py-2 px-4 text-left">
                            Số lượng
                        </th>
                        <th class="py-2 px-4 text-left">
                            Hành động
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="py-2 px-4">
                            1
                        </td>
                        <td class="py-2 px-4">
                            Áo polo thể thao nam
                        </td>
                        <td class="py-2 px-4">
                            230,000đ
                        </td>
                        <td class="py-2 px-4">
                            Đồ thể thao
                        </td>
                        <td class="py-2 px-4">
                            <img alt="Áo polo thể thao nam" class="w-8 h-8" height="50"
                                src="https://storage.googleapis.com/a1aa/image/GyfjfKR-hzOkC8vVAbfZ3fp79V7DAK90IDgMVooMNUk.jpg"
                                width="50" />
                        </td>
                        <td class="py-2 px-4">
                            23
                        </td>
                        <td class="py-2 px-4">
                            <i class="fas fa-trash text-red-500">
                            </i>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 px-4">
                            2
                        </td>
                        <td class="py-2 px-4">
                            Áo thun nam cơ bản
                        </td>
                        <td class="py-2 px-4">
                            220,000đ
                        </td>
                        <td class="py-2 px-4">
                            Đồ thun
                        </td>
                        <td class="py-2 px-4">
                            <img alt="Áo thun nam cơ bản" class="w-8 h-8" height="50"
                                src="https://storage.googleapis.com/a1aa/image/iy6V7poAXoj3iY8bO9LhLSRxIoC13INM5ZfLa5y_E9g.jpg"
                                width="50" />
                        </td>
                        <td class="py-2 px-4">
                            11
                        </td>
                        <td class="py-2 px-4">
                            <i class="fas fa-trash text-red-500">
                            </i>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-between items-center mt-4">
                <div>
                    Trang 1 của 9
                </div>
                <div class="flex space-x-2">
                    <button class="px-2 py-1 border">
                        1
                    </button>
                    <button class="px-2 py-1 border">
                        2
                    </button>
                    <button class="px-2 py-1 border">
                        3
                    </button>
                    <button class="px-2 py-1 border">
                        4
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
