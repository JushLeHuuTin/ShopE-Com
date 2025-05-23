@extends('header')
@section('content')
<div class="content">
    <div class="conatiner">
       <div class="row justify-content-center">
            <div class="col-md-6 col-10">
                <form id="form-1"  method="POST" action="processlogin.php" class="d-flex flex-column align-items-center form" novalidate>
                    <h3 class="mt-3">Creater Accout</h3>
                    <span class="msg d-inline-block mb-5">(You need to create an account to access the homepage !)</span>
                    <div class="form-group">
                        <input  class=" form-control" type="text" name="fullName" id="fullName" placeholder="Full name" required pattern="([a-zA-Z0-9]{3,}\s)+([a-zA-Z0-9]{3,})">
                        <div class="invalid-feedback">* Vui long khong bo trong</div>
                        <span></span>
                    </div>
                    <!-- <div class="form-group">
                        <input  class="form-control" type="text" name="phone" id="phone" placeholder="phone" required pattern="\d{10,11}">
                        <div class="invalid-feedback">* vui long khong bo trong</div>
                        <span></span>
                    </div> -->
                    
                    <div class="form-group">
                        <input  class="form-control" type="email" name="email" id="email" placeholder="Email" required pattern="\w+([\.\-]\w+)*@\w+(\.\w+)*(\.\w{2,4})">
                        <div class="invalid-feedback">* Truong ngay la email</div>
                        <span></span>
                    </div>
                    <div class="form-group">
                        <div class="position-relative">
                            <input  class="form-control" type="password" name="password" id="password" placeholder="Password" required  pattern="\S{10,}">
                            <div class="invalid-feedback">* Mat khau toi thieu 10 ki tu</div>
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <span></span>
                    </div>
                    <div class="form-group">
                        <div class="position-relative">
                            <input  class="form-control" type="password" name="password-replay" id="password-replay" placeholder="Re-enter password" required>
                            <div class="invalid-feedback">* Mat khau nhap lai khong khop</div>
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <span></span>
                    </div>
                    <button>Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
