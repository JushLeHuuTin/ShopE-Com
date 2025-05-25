<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa thông tin cá nhân</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-4">
        <h2>Chỉnh sửa thông tin cá nhân</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Họ và tên:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->username }}" required
                    maxlength="255">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required
                    pattern="[0-9]{10}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                <small class="form-text text-muted">Email không thể chỉnh sửa.</small>
            </div>
            <button type="submit" class="btn btn-success" style="width: 120px; height: 40px;">Lưu thay đổi</button>
            <div class="text-center mt-3">
                <a href="{{ route('index') }}" class="btn btn-outline-secondary">Back to home</a>
            </div>
        </form>
    </div>
</body>

</html>