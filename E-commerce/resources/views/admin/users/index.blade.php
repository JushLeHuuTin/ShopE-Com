<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách người dùng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Danh sách người dùng</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif

        @if($users->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Role</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? '---' }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                @if($user->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @if($user->is_active)
                                    <form action="{{ route('admin.users.lock', $user->id_user) }}" method="POST" class="lock-form">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Khóa tài khoản</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.users.unlock', $user->id_user) }}" method="POST" class="unlock-form">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Kích hoạt</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div>
                {{ $users->links() }}
            </div>
        @else
            <p>Danh sách người dùng trống.</p>
        @endif

        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Xác nhận hành động</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc chắn muốn <span id="modal-action-text"></span> tài khoản của người dùng <span id="modal-username-text"></span> này?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary" id="confirmActionButton">Xác nhận</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lockForms = document.querySelectorAll('.lock-form');
            const unlockForms = document.querySelectorAll('.unlock-form');
            const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            const modalActionText = document.getElementById('modal-action-text');
            const modalUsernameText = document.getElementById('modal-username-text');
            const confirmActionButton = document.getElementById('confirmActionButton');
            let currentFormToSubmit = null;

            lockForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const userId = this.action.split('/').pop();
                    const username = this.closest('tr').querySelector('td:first-child').textContent;
                    modalActionText.textContent = 'vô hiệu hóa';
                    modalUsernameText.textContent = username;
                    currentFormToSubmit = this;
                    confirmationModal.show();
                });
            });

            unlockForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const userId = this.action.split('/').pop();
                    const username = this.closest('tr').querySelector('td:first-child').textContent;
                    modalActionText.textContent = 'kích hoạt';
                    modalUsernameText.textContent = username;
                    currentFormToSubmit = this;
                    confirmationModal.show();
                });
            });

            confirmActionButton.addEventListener('click', function() {
                if (currentFormToSubmit) {
                    currentFormToSubmit.submit();
                }
            });
        });
    </script>
</body>

</html>