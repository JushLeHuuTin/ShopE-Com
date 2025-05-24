<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
    </style>
</head>

<body>
    <!-- Start Section Review -->
    <!-- Start Section Review -->
    <section class="py-5">
        <div class="container d-flex justify-content-center">
            <div class="card shadow p-4 w-100" style="max-width: 700px;">
                {{-- <form action="{{ route('review') }}" method="POST"> --}}
                    {{-- @csrf --}}
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
                    </div>

                    <button type="submit" class="btn btn-danger w-100 fw-bold">Gửi</button>
                    {{--
                </form> --}}
            </div>
        </div>
    </section>
    <!-- End Section Review -->
    @include('displayreview')

    <script>
        const stars = document.querySelectorAll('.star');
        const rating = document.getElementById('rating');

        //star
        stars.forEach(star => {
            star.addEventListener('click', function () {
                const rateStar = this.getAttribute('data-value'); // Lấy giá trị sao từ `data-value`
                stars.forEach(s => s.classList.remove('active')); // Xóa trạng thái active của các sao
                for (let i = 1; i <= rateStar; i++) {
                    document.querySelector(`.star[data-value="${i}"]`).classList.add('active');
                }
                rating.value = rateStar; // Gán giá trị sao vào `rating`
            });
        });

        // function checkComment() {
        //     if (comment.trim() === "") {
        //         alert("Vui lòng nhập đánh giá của bạn");
        //         return false;
        //     }
        //     return true;
        // }
    </script>
</body>

</html>