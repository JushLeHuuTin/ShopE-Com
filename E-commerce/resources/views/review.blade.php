<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('/css/review.css') }}">
    <title>Đánh giá</title>
    <style>
        .star {
            font-size: 1.4rem;
            color: #ccc;
            cursor: pointer;
        }

        .star.active {
            color: gold;
        }

        .comment {
            height: 350px;
            box-shadow: 2px 4px 8px rgba(0, 0, 0, .4);
            resize: none;
            border: none;
            outline: none;
        }

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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .btn-status {
            position: fixed;
            left: calc(50% - 25px);
            bottom: 10px;
        }

        .status-title {
            width: 100%;
            height: 30px;
            background: blue;
            color: white;
            border-radius: 5px 5px 0 0;
        }
    </style>
</head>

<body>
    <!-- Start Section Review -->
    <section class="py-5">
        <div class="container d-flex justify-content-center">
            <div class="card shadow p-4 w-100" style="max-width: 700px;">
                <form action="{{ route('review') }}" method="POST">
                    @csrf
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="{{ asset('/images/home7_6.jpg') }}" alt="Ảnh sản phẩm" class="img-fluid rounded"
                            style="width: 100px;">
                        <div class="fs-5 fw-semibold">Áo thun nam</div>
                        <input type="hidden" name="id_user" id="id_user" value="1">
                        <input type="hidden" name="id_product" id="id_product" value="2">
                    </div>

                    <h5 class="mb-2">Đánh giá sản phẩm</h5>
                    <div class="d-flex gap-2 mb-3">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star star" data-value="{{ $i }}"></i>
                        @endfor
                        <input type="hidden" name="rating" id="rating" value="0">
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label fw-semibold">Viết đánh giá</label>
                        <textarea name="comment" id="comment" class="form-control comment" rows="5"
                            placeholder="Viết đánh giá sản phẩm tại đây..."></textarea>
                        <div id="commentError" class="text-danger mt-1" style="display: none;"></div>
                    </div>

                    <button type="submit" class="btn btn-danger btn-submit w-100 fw-bold">Gửi</button>
                </form>
            </div>
        </div>
    </section>
    <!-- End Section Review -->
    <div class="status-container" style="display: none">
        <div class="status-infor d-block text-center">
            <div class="status-title">Thông báo</div>
            <p class="mt-4" id="statusMessageText"></p>
            <button type="button" class="btn btn-outline-primary btn-status">OK</button>
        </div>
    </div>

    <script>
        const stars = document.querySelectorAll('.star');
        const rating = document.getElementById('rating');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const rateStar = this.getAttribute('data-value');
                stars.forEach(s => s.classList.remove('active'));
                for (let i = 1; i <= rateStar; i++) {
                    document.querySelector(`.star[data-value="${i}"]`).classList.add('active');
                }
                rating.value = rateStar;
            });
        });

        const btnSubmit = document.querySelector('.btn-submit');
        const commentInput = document.getElementById('comment');
        const commentError = document.getElementById('commentError');

        const statusContainer = document.querySelector('.status-container');
        const statusMessageText = document.getElementById('statusMessageText');
        const btnStatus = document.querySelector('.btn-status');

        const regex = /^(?!\s)(?!.*\s{2})[\s\S]{1,255}$/;

        // Kiểm tra lỗi ngay khi người dùng đang nhập comment (có thể giữ hoặc bỏ)
        commentInput.addEventListener('input', function () {
            const comment = commentInput.value;

            if (!regex.test(comment)) {
                commentError.style.display = 'block';
                commentError.textContent = "Đánh giá không hợp lệ: không bắt đầu bằng khoảng trắng, không có 2 khoảng trắng liên tiếp, và tối đa 255 ký tự.";
            } else {
                commentError.style.display = 'none';
                commentError.textContent = '';
            }
        });

        // Xử lý đóng thông báo
        btnStatus.addEventListener('click', () => {
            statusContainer.style.display = 'none';
        });

        // Xử lý gửi form
        document.querySelector('form').addEventListener('submit', function (e) {
            e.preventDefault(); // Chặn gửi form mặc định

            // Ẩn lỗi comment cũ
            commentError.style.display = 'none';
            commentError.textContent = '';

            let errors = [];

            // Kiểm tra rating
            if (parseInt(rating.value) === 0) {
                errors.push('Vui lòng chọn số sao đánh giá.');
            }

            // Kiểm tra comment
            const comment = commentInput.value;
            if (!regex.test(comment)) {
                errors.push("Đánh giá không hợp lệ: không bắt đầu bằng khoảng trắng, không có 2 khoảng trắng liên tiếp, và tối đa 255 ký tự.");
            }

            if (errors.length > 0) {
                // Hiển thị lỗi trong popup
                statusMessageText.innerHTML = errors.join('<br>');
                statusContainer.style.display = 'block';
                return; // dừng không gửi form
            }

            // Nếu hợp lệ thì disable nút gửi và gửi form thủ công
            btnSubmit.disabled = true;
            btnSubmit.innerText = 'Đang gửi...';
            this.submit();
        });
    </script>
</body>

</html>