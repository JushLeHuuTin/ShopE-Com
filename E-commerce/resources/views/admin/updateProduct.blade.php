@extends('layout.admin')

@section('title', 'Quản lý San pham')

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h1 class="border-bottom pb-2 mb-4 h5">Cập nhật sản phẩm</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('product.postEdit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3 justify-content-end">
                        <input type="hidden" name="updated_at" value="{{ $product->updated_at }}">
                        <input name="id" type="text" value="{{ $product->id_product }}"
                            class="form-control form-control-sm" hidden />
                        <div class="col-md-6">
                            <label class="form-label">Tên sản phẩm</label>
                            <input name="name" type="text" class="form-control form-control-sm"
                                value="{{ $product->name }}" />
                            @if ($errors->has('name'))
                                <div class="text-danger small">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Danh mục</label>
                            <select name="categories" class="form-select form-select-sm">
                                <option value="1">Chọn danh mục</option>
                                @foreach ($categories as $item)
                                    @if ($item->id_category != $product->category->id_category)
                                        <option value="{{ $item->id_category }}">{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id_category }}" selected>{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hình ảnh</label>
                            <input type="file" name="image"
                                id="img_product"class="form-control form-control-sm mb-2" />
                            @if ($errors->has('image'))
                                <div class="text-danger small">{{ $errors->first('image') }}</div>
                            @endif
                            {{-- {{ $product }} --}}
                            <img class="display_img" src="{{ asset('images/' . $product->image_url) }}" alt=""
                                style="width:50px; height:70px;">

                            <!-- Modal hiển thị ảnh to -->
                            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <img id="modalImage" src="" alt="Ảnh to" class="w-100">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <label class="form-label">Mô tả</label>
                                <textarea name="desc" class="form-control form-control-sm" name="description" rows="3"
                                    placeholder="Điền mô tả của sản phẩm" value="{{ $product->description }}">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-check my-3">
                                @if ($product->is_featured == 0)
                                    <input name="is_featured" type="checkbox" class="form-check-input" id="isFeatured">
                                @else
                                    <input name="is_featured" type="checkbox" checked class="form-check-input"
                                        id="isFeatured">
                                @endif
                                <label class="form-check-label" for="isFeatured">Nổi bật</label>
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <button id="btn-update" type="submit" style="border:1px solid black; box-shadow:1px 1px 1px black"
                                class="btn btn-primary btn-sm btn-submit">Cập nhật</button>
                        </div>
                    </div>

                </form>
                <div class="row my-2">
                    <h3>Danh sách biến thể:</h3>
                    <table class="border border-dark text-center">
                        <tr>
                            <th>Kích cỡ</th>
                            <th>Màu sắc</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Hành động</th>
                        </tr>

                        <tr>
                            <td>XL</td>
                            <td>Đen</td>
                            <td>230.000đ</td>
                            <td>23</td>
                            <td>
                                <a href="" class="update_product" class="inline-block mx-1 p-1">
                                    <i class="fas fa-pen text-red-500 cursor-pointer">
                                    </i>
                                </a>

                                <a href="" class="inline-block mx-1 p-1">
                                    <i class="fas fa-trash text-red-500 cursor-pointer">
                                    </i>
                                </a>

                            </td>
                        </tr>
                        <tr>
                            <td>XL</td>
                            <td>Đen</td>
                            <td>230.000đ</td>
                            <td>23</td>
                            <td class="p-2">
                                <a href="" class="update_product" class="inline-block mx-1 p-1">
                                    <i class="fas fa-pen text-red-500 cursor-pointer">
                                    </i>
                                </a>

                                <a href="" class="inline-block mx-1 p-1">
                                    <i class="fas fa-trash text-red-500 cursor-pointer">
                                    </i>
                                </a>

                            </td>
                        </tr>
                    </table>
                </div>
                <div class="row">
                    <h4>Thêm biến thể mới:</h4>
                    <div class="add_variant col-md-6">
                        <form action="" class="text-end">
                            <div class="form-row d-flex my-2 m-100">
                                <label class="text-start" style="min-width:90px" for="size">Kích cỡ</label>
                                <select name="" id="size" class="w-100">
                                </select>
                            </div>
                            <div class="form-row d-flex my-2">
                                <label class="text-start" style="min-width:90px" for="color">Màu sắc</label>
                                <select name="" id="color" class="w-100"></select>
                            </div>
                            <div class="form-row d-flex my-2">
                                <label class="text-start" style="min-width:90px" for="price">Giá</label>
                                <input name="" id="price"class="w-100"></input>
                            </div>
                            <div class="form-row d-flex my-2">
                                <label class="text-start" style="min-width:90px" for="quantity">Số lượng</label>
                                <input name="" id="quantity"class=" w-100"></input>
                            </div>
                            <input type="submit" class="btn-primary p-2" style="border-radius:3px"
                                value="Thêm biến thể mới">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
