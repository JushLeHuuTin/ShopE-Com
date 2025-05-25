<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa địa chỉ giao hàng</title>
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
        <h2 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Sửa địa chỉ giao hàng</h2>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Lỗi!</strong>
                <span class="block sm:inline">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </span>
            </div>
        @endif

        <form action="{{ route('shipping_addresses.update', $shippingAddress->id_address) }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="full_name" class="block text-gray-700 text-sm font-bold mb-2">Họ và tên người nhận:</label>
                <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $shippingAddress->full_name) }}" required maxlength="255" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $shippingAddress->phone) }}" required pattern="[0-9]{10}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Địa chỉ chi tiết:</label>
                <textarea id="address" name="address" rows="4" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('address', $shippingAddress->address) }}</textarea>
            </div>
            <div class="mb-4">
                <label for="default_address" class="inline-flex items-center">
                    <input type="checkbox" id="default_address" name="default_address" value="1" {{ $shippingAddress->default_address ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-blue-600 rounded">
                    <span class="ml-2 text-gray-700 text-sm">Đặt làm địa chỉ mặc định</span>
                </label>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="btn btn-warning inline-flex items-center">
                    <i class="fas fa-save mr-2"></i> Cập nhật
                </button>
                <a href="{{ route('shipping_addresses.index') }}" class="btn btn-secondary ml-2 inline-flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Quay lại
                </a>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>