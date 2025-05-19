<?php
use App\Http\Controllers\CrudProductController;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\AuthOtpController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShippingAddressController;

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
    Route::post('/admin/users/{id}/lock', [AdminController::class, 'lockUser'])->name('admin.users.lock');
    Route::post('/admin/users/{id}/unlock', [AdminController::class, 'unlockUser'])->name('admin.users.unlock');
});

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/transaction-history', [InvoiceController::class, 'index'])->name('transaction.history');
});

// Route để hiển thị chi tiết đơn hàng
Route::get('/hoa-don/{id}', [InvoiceController::class, 'show']);


// Route để hiển thị chi tiết đơn hàng
Route::get('/hoa-don/{id}', [InvoiceController::class, 'show']);


Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});


// Các route cho quản lý địa chỉ giao hàng
Route::middleware('auth')->group(function () {
    Route::prefix('shipping-addresses')->name('shipping_addresses.')->group(function () {
        Route::get('/', [ShippingAddressController::class, 'index'])->name('index'); // Danh sách địa chỉ
        Route::get('/create', [ShippingAddressController::class, 'create'])->name('create'); // Form thêm địa chỉ
        Route::post('/', [ShippingAddressController::class, 'store'])->name('store'); // Xử lý thêm địa chỉ
        Route::get('/{shippingAddress}/edit', [ShippingAddressController::class, 'edit'])->name('edit'); // Form sửa địa chỉ
        Route::put('/{shippingAddress}', [ShippingAddressController::class, 'update'])->name('update'); // Xử lý sửa địa chỉ
        Route::delete('/{shippingAddress}', [ShippingAddressController::class, 'destroy'])->name('destroy'); // Xử lý xóa địa chỉ
    });
});

Route::post('/profile/password/change', [CrudUserController::class, 'changePassword'])->name('profile.password.change');
Route::get('/profile/password/change', [CrudUserController::class, 'showChangePasswordForm'])->name('profile.password.index');