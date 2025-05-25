<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý địa chỉ giao hàng</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@latest"></script>
    <style>
        /* Custom CSS để ghi đè màu mặc định của Tailwind (nếu cần) */
        .btn-primary {
            background-color: #3b82f6; /* Màu xanh dương đậm */
        }
        .btn-primary:hover {
            background-color: #2563eb; /* Màu xanh dương đậm hơn khi hover */
        }
        .btn-secondary {
            background-color: #6b7280; /* Màu xám */
        }
        .btn-secondary:hover {
            background-color: #4b5563; /* Màu xám đậm hơn khi hover */
        }
        .btn-success {
            background-color: #16a34a; /* Màu xanh lá cây */
        }
        .btn-success:hover {
            background-color: #15803d; /* Màu xanh lá cây đậm hơn khi hover */
        }
        .btn-warning {
            background-color: #f59e0b; /* Màu vàng cam */
        }
        .btn-warning:hover {
            background-color: #d97706; /* Màu vàng cam đậm hơn khi hover */
        }
        .btn-danger {
            background-color: #dc2626; /* Màu đỏ */
        }
        .btn-danger:hover {
            background-color: #b91c1c; /* Màu đỏ đậm hơn khi hover */
        }
    </style>
</head>
<body class="bg-gray-100 font-inter">
    <div class="container mx-auto py-8">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Quản lý địa chỉ giao hàng</h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Thành công!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="text-center mb-4">
            <a href="{{ route('shipping_addresses.create') }}" class="btn btn-primary inline-flex items-center">
                <i class="fas fa-plus mr-2"></i> Thêm địa chỉ mới
            </a>
        </div>

        @if($addresses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($addresses as $address)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h5 class="text-xl font-semibold text-gray-800 mb-2 flex items-center">
                            {{ $address->full_name }}
                            @if($address->default_address)
                                <span class="ml-2 bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded">Mặc định</span>
                            @endif
                        </h5>
                        <p class="text-gray-600 mb-1"><strong>Số điện thoại:</strong> {{ $address->phone }}</p>
                        <p class="text-gray-700 mb-4"><strong>Địa chỉ:</strong> {{ $address->address }}</p>
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('shipping_addresses.edit', $address->id_address) }}" class="btn btn-sm btn-warning inline-flex items-center">
                                <i class="fas fa-edit mr-1"></i> Sửa
                            </a>
                            <form action="{{ route('shipping_addresses.destroy', $address->id_address) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa địa chỉ này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger inline-flex items-center">
                                    <i class="fas fa-trash-alt mr-1"></i> Xóa
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded relative" role="alert">
                <p class="font-bold">Thông báo!</p>
                <p class="block sm:inline">Chưa có địa chỉ giao hàng nào. Hãy thêm mới.</p>
            </div>
        @endif
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
