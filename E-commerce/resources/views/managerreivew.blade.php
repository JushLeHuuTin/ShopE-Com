<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('/css/managerreview.css') }}">
    <title>Quản lý đánh giá</title>
</head>

<body>
    <!-- Start Layout -->
    <section class="admin">
        <div class="row-grid">
            <div class="admin-sidebar">
                <div class="admin-sidebar-top">
                    <div class="avatar-admin">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <div class="name-admin">Admin</div>
                </div>
                <div class="admin-sidebar-content">
                    <ul>
                        <li><a href=""><i class="ri-box-3-line"></i>Quản lý Sản phẩm</a></li>
                        <li><a href=""><i class="fa-solid fa-calendar"></i>Quản lý Đơn hàng</a></li>
                        <li><a href=""><i class="ri-feedback-line"></i>Quản lý Đánh giá</a></li>
                        <li><a href=""><i class="ri-shield-user-line"></i>Quản lý Người dùng</a></li>
                        <li><a href=""><i class="ri-bar-chart-2-line"></i>Thống kê</a></li>
                        <li><a href=""><i class="ri-file-chart-line"></i>Báo cáo<i class="ri-arrow-down-s-fill"></i></a>
                            <ul class="sub-menu">
                                <div class="sub-menu-items">
                                    <li><a href=""></a><i class="ri-arrow-right-s-fill"></i>Doanh thu</li>
                                    <li><a href=""></a><i class="ri-arrow-right-s-fill"></i>Số lượng sản phẩm</li>
                                    <li><a href=""></a><i class="ri-arrow-right-s-fill"></i>Sản phẩm tốt nhất</li>
                                </div>
                            </ul>
                        </li>
                        <li><a href=""><i class="ri-discount-percent-line"></i>Khuyến mãi</a></li>
                    </ul>
                </div>
            </div>
            <div class="admin-content">
                <div class="admin-content-top">
                    <div class="admin-content-top-left">
                        <ul class="flex-box">
                            <li>
                                <form action="review.php">
                                    <div class="search">
                                        <input type="text" placeholder="Tìm kiếm" class="search-input">
                                        <i class="ri-search-line"></i>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="admin-content-top-right">
                        <ul class="flex-box">
                            <li><i class="fa-solid fa-bell" number="1"></i></li>
                            <li><i class="fa-solid fa-envelope" number="2"></i></li>
                            <li>
                                <i class="fa-solid fa-user-tie"></i>
                                <p>Admin</p>
                                <i style="font-size: 1.3em;" class="ri-arrow-down-s-fill"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="admin-content-review">
                    <div class="admin-content-review-title">
                        <h1>Quản lý đánh giá</h1>
                    </div>
                    <div class="admin-content-review-table">
                        <div class="admin-content-review-table-list">
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
                                            <td>{{ $review->user->username }}</td>
                                            <td><img src="{{ asset('images/' . $review->product->image_url) }}" alt="" style="width: 70px;"></td>
                                            <td>{{ $review->product->name }}</td>
                                            <td>{{ $review->rating }}<i class="fa-solid fa-star" style="color: #FFD43B;"></i></td>
                                            <td class="content-review">{{ $review->comment }}</td>
                                            <td>{{ $review->created_at->format('H:i:s d-m-Y') }}</td>
                                            <td>{{ $review->status }}</td>
                                            <td>
                                                <div class="review-action" style="justify-content: center;">
                                                    <form action="{{ route('review.approve', $review->id_review) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn-approved">Duyệt</button>
                                                    </form>
                                                    <form action="{{ route('review.hide', $review->id_review) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn-pending">Ẩn</button>
                                                    </form>
                                                    <form action="{{ route('review.delete', $review->id_review) }}" method="POST">
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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Layout -->

    <script>
        const menuLi = document.querySelectorAll('.admin-sidebar-content > ul > li > a');
        const submenu = document.querySelectorAll('.sub-menu');

        for (let index = 0; index < menuLi.length; index++) {
            menuLi[index].addEventListener('click', (e) => {

                e.preventDefault()

                // for (let i = 0; i < submenu.length; i++) {
                //     submenu[i].setAttribute("style", "height: 0px")

                // }
                menuLi[index].parentNode.querySelector('ul').classList.toggle('active')
                // const submenuHeight = menuLi[index].parentNode.querySelector('ul .sub-menu-items').offsetHeight
                // menuLi[index].parentNode.querySelector('ul').setAttribute("style", "height: " + submenuHeight + "px")

            });
        }
    </script>
</body>

</html>