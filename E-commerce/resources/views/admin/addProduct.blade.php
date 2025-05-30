@extends('layout.admin')

@section('title', 'Quản lý San pham')

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="border-bottom pb-2 mb-4 h5">Thêm mới sản phẩm</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('product.postProduct') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Tên sản phẩm</label>
                            <input name="name" type="text" class="form-control form-control-sm" />
                            @if ($errors->has('name'))
                                <div class="text-danger small">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Giá</label>
                            <input name="price" type="number"
                                onkeydown="return !['e', 'E', '+', '-'].includes(event.key)" step="0.01"
                                class="form-control form-control-sm" />
                            @if ($errors->has('price'))
                                <div class="text-danger small">{{ $errors->first('price') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Hình ảnh</label>
                            <input type="file" name="image" class="form-control form-control-sm" />
                            @if ($errors->has('image'))
                                <div class="text-danger small">{{ $errors->first('image') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Danh mục</label>
                            <select name="categories" class="form-select form-select-sm">
                                <option value="4">Chọn danh mục</option>
                                @foreach ($category as $categies)
                                    <option value="{{ $categies->id_category }}">{{ $categies->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Số lượng</label>
                            <input name="quantity" type="number" min="1"
                                onkeydown="return !['e', 'E', '+', '-'].includes(event.key)"
                                class="form-control form-control-sm" />
                            @if ($errors->has('quantity'))
                                <div class="text-danger small">{{ $errors->first('quantity') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kích cỡ</label>
                            <select name="size" class="form-select form-select-sm">
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                                <option value="XXXL">XXXL</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Màu sắc</label>
                            <select name="color" id="colorSelect" class="form-select form-select-sm"
                                onchange="handleColorChange()">
                                <option value="Đen">Đen</option>
                                <option value="Đỏ">Đỏ</option>
                                <option value="custom">Khác...</option>
                            </select>
                            <input name="colorOther" type="text" id="customColorInput"
                                class="form-control form-control-sm mt-2 d-none" placeholder="Nhập màu sắc...">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Mô tả</label>
                            <textarea name="desc" class="form-control form-control-sm" name="description" rows="3"
                                placeholder="Điền mô tả của sản phẩm"></textarea>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check">
                                <input name="is_featured" type="checkbox" class="form-check-input" id="isFeatured">
                                <label class="form-check-label" for="isFeatured">Nổi bật</label>
                            </div>
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit" style="border:1px solid black; box-shadow:1px 1px 1px black" class="btn btn-primary btn-sm">Thêm mới</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
