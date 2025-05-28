<link rel="stylesheet" href="{{ asset('/css/managerreview.css') }}">

<style>
    .status-container {
        position: fixed;
        width: 300px;
        height: 200px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
        background: #fee2e2;
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
        font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
    }

    .btn-status {
        position: fixed;
        left: calc(50% - 25px);
        bottom: 10px;
    }
</style>

@extends('layout.admin')


@section('title', 'Quản lý Đánh Giá')

@section('content')
    <div class="admin-content">
        <div class="admin-content-review">
            <div class="admin-content-review-title">
                <h1 class="border-bottom pb-2 mb-4 h5">Quản lý đánh giá</h1>
            </div>
            <div class="admin-content-review-table">
                <div class="admin-content-review-table-list">
                    @if ($reviews->isEmpty())
                        <p>Khong co danh gia nao</p>
                    @else
                        <table>
                            <thead>
                                <tr>
                                    <th>Mã đánh giá</th>
                                    <th>Tên khách hàng</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số sao</th>
                                    <th>Nội dung</th>
                                    <th>Ngày đánh giá</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $review->id_review }}</td>
                                        <td>{{ $review->users->username }}</td>
                                        <td><img src="{{ asset('images/' . $review->product->image_url) }}" alt=""
                                                style="width: 70px;"></td>
                                        <td>{{ $review->product->name }}</td>
                                        <td>{{ $review->rating }}⭐</td>
                                        <td class="content-review">{{ $review->comment }}</td>
                                        <td>{{ $review->created_at }}</td>
                                        <td>{{ $review->status }}</td>
                                        <td>
                                            <div class="review-action" style="justify-content: center;">
                                                <form action="{{ route('approve', $review->id_review) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn-approved">Duyệt</button>
                                                </form>
                                                <form action="{{ route('hide', $review->id_review) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn-pending">Ẩn</button>
                                                </form>
                                                <form action="{{ route('delete', $review->id_review) }}" method="POST"
                                                    onclick="return confirm('Bạn có muốn xóa không?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-rejected">Xóa</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $reviews->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="status-container" style="display: none">
        <div class="status-infor d-block text-center">
            <div class="status-title">Thông báo</div>
            <p class="mt-4" id="statusMessageText"></p>
            <button type="button" class="btn btn-outline-primary btn-status">OK</button>
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
    window.addEventListener('DOMContentLoaded', () => {
        const formStatus = document.querySelector('.status-container');
        const messageText = document.getElementById('statusMessageText');
        const btnStatus = document.querySelector('.btn-status');

        // Lấy thông báo từ session
        @if (session('message'))
            formStatus.style.display = 'block';
            messageText.innerText = "{{ session('message') }}";
        @endif

        @if (session('error'))
            formStatus.style.display = 'block';
            messageText.innerText = "{{ session('error') }}";
            formStatus.style.backgroundColor = '#f8d7da'; // màu đỏ cho lỗi
        @endif

        // Xử lý nút OK
        btnStatus?.addEventListener('click', () => {
            formStatus.style.display = 'none';
        });
    });

    
</script>
