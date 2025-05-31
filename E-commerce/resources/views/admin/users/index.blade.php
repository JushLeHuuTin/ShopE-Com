@extends('layout.admin')

@section('title', 'Quản lý người dùng')

@section('content')
<div class="h-100 position-relative">
    <h2 class="text-xl font-bold mb-4">Danh sách người dùng</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-green-500 text-white">
                <th class="p-2">Họ tên</th>
                <th class="p-2">Email</th>
                <th class="p-2">Số điện thoại</th>
                <th class="p-2">Role</th>
                <th class="p-2">Trạng thái</th>
                <th class="p-2">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">{{ $user->username }}</td>
                    <td class="p-2">{{ $user->email }}</td>
                    <td class="p-2">{{ $user->phone ?? '---' }}</td>
                    <td class="p-2">{{ ucfirst($user->role) }}</td>
                    <td class="p-2">
                        @if($user->is_active)
                            <span class="bg-green-500 text-white rounded px-2 py-1 text-sm">Hoạt động</span>
                        @else
                            <span class="bg-gray-400 text-white rounded px-2 py-1 text-sm">Bị khoá</span>
                        @endif
                    </td>
                    <td class="p-2 flex space-x-3">
                        @if($user->is_active)
                            <form action="{{ route('admin.users.lock', $user->id_user) }}" method="POST">
                                @csrf
                                <button type="submit" title="Khóa tài khoản">
                                    <i class="fas fa-lock text-red-500 hover:text-red-700 cursor-pointer"></i>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.users.unlock', $user->id_user) }}" method="POST">
                                @csrf
                                <button type="submit" title="Kích hoạt tài khoản">
                                    <i class="fas fa-unlock text-green-500 hover:text-green-700 cursor-pointer"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">Không có người dùng nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
