@extends('header')
@section('content')
<div class="content">
    <div class="conatiner">
       <div class="row justify-content-center">
            <div class="col-md-6 col-10">
                <form   action="" id="form-1"class="form" novalidate>
                    <h3 class="mt-3 mb-5 text-center">LOGIN</h3>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email" required pattern="\w+(\.\w+)*@\w+(\.\w+)*(\.\w{2,4})">
                        <div class="invalid-feedback">* Trường này là email</div>
                        <span></span>
                    </div>
                    <div class="form-group position-relative">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" required pattern="\S{10,}">
                        <div class="invalid-feedback">* Tối thiểu 10 kí tự</div>
                        <i class="fa-solid fa-eye"></i>
                        <span></span>
                    </div>
                    <div class="form-group position-relative">
                        <span class="captcha-number">Xác thực captcha: </span>
                        <input class="form-control" type="text" name="captcha" id="captcha" placeholder="Captcha" required>
                        <div class="invalid-feedback">* Nhập lại mã captcha</div>
                        <span></span>
                    </div>
                    <a href="" class="forgot-pass text-start text-link text-decoration-none">Forgot your password?</a>
                    <input type="submit" class="btn-submit__login" value="Log in">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
