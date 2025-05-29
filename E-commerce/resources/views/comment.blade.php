<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Product Reviews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="tab__panel px-3">
    <div class="product-review">
        <div class="title my-2 fs-5">{{ $averageRating }}⭐ Đánh giá sản phẩm ({{ $commentCount }})</div>
        @foreach($comments as $comment)
            <div class="card mb-4">
                <div class="card-body" style="background: #efefef;">
                    <div class="card-item">
                        <div class="card-infor d-flex gap-3 align-items-center">
                            <img style="width:40px;" src="{{ asset('images/user.png') }}" alt="">
                            <div class="user-name">{{ $comment->username }}</div>
                        </div>
                        <div class="card-rating my-2">
                            {{ str_repeat('⭐', $comment->rating) }}
                        </div>
                        <div class="card-product-name my-2">
                            {{ $comment->product_name }}
                        </div>
                        <p>{{ $comment->comment }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>