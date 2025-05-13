<?php
use App\Http\Controllers\CrudProductController;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\AuthOtpController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Đăng ký + OTP
    Route::get('/register', [AuthOtpController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthOtpController::class, 'register'])->name('register.submit');
    Route::get('/send-otp', [AuthOtpController::class, 'showSendOtpForm'])->name('send.otp.form');
    Route::post('/send-otp', [AuthOtpController::class, 'sendOtp'])->name('send.otp');
    Route::get('/verify-otp', [AuthOtpController::class, 'showOtpForm'])->name('verify.otp.form');
    Route::post('/verify-otp', [AuthOtpController::class, 'verify'])->name('verify.otp.submit');

    // Trang chủ sản phẩm
    Route::get('/index', [CrudProductController::class, 'index'])->name('index');

    // Admin routes
    //Route::get('/admin', [AdminController::class, 'index'])->name('admin.users.index');
    // GET route để hiện danh sách hoặc form khóa user
    Route::post('/admin/users/lock', [AdminController::class, 'lock'])->name('admin.users.lock');

    // POST route để thực hiện hành động khóa user
    //Route::post('/admin/users/{id}/lock', [AdminController::class, 'lockUser'])->name('admin.users.lock.active');

    // GET + POST tương tự cho unlock
    //Route::get('/admin/users/unlock', [AdminController::class, 'unlock'])->name('admin.users.unlock');
    Route::post('/admin/users/unlock', [AdminController::class, 'unlockUser'])->name('admin.users.unlock.active');
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/transaction-history', [InvoiceController::class, 'index'])->name('transaction.history');
});

// Route để hiển thị chi tiết đơn hàng
Route::get('/hoa-don/{id}', [InvoiceController::class, 'show']);



// Route để hiển thị chi tiết đơn hàng
Route::get('/hoa-don/{id}', [InvoiceController::class, 'show']);
