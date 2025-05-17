<?php
use Illuminate\Support\Str;
?>
@extends('layout.admin')

@section('title', 'Quản lý Sản Phẩm')

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="border-bottom pb-2 mb-4 h5">Danh Sách Sản Phẩm</h1>

        <div class="row justify-content-center text-center">
            <table class="w-full bg-white rounded shadow mb-4">
                <tbody style="background: #f8f9fa;">
                    <tr class="bg-green-500" style="color:#343a40">
                        <th class="p-2" colspan="1">
                            ID
                        </th>
                        <th class="p-2" colspan="1">
                            Tên sản phẩm
                        </th>
                        <th class="p-2" colspan="1">
                            Giá
                        </th>
                        <th class="p-2" colspan="1">
                            Danh mục
                        </th>
                        <th class="p-2" colspan="1">
                            Hình ảnh
                        </th>
                        <th class="p-2" colspan="1">
                            Số lượng
                        </th>
                        <th class="p-2" colspan="1">
                            Hành động
                        </th>
                    </tr>
                    @foreach ($products as $product)
                        <tr class="border-b">
                            <td class="p-2">
                                {{ $product->id_product }}
                            </td>
                            <td class="p-2"style="max-width: 240px !important;">
                                {{ $name = Str::words($product->name, 8, '...') }}
                            </td>
                            <td class="p-2">
                                @if (isset($product->defaultVariant->price))
                                    {{ number_format($product->defaultVariant->price, 0, ',', '.') }}₫
                                @else
                                    Chưa cập nhật
                                @endif
                            </td>
                            <td class="p-2">
                                {{ $product->category->name }}
                            </td>
                            <td class="p-2">
                                @if ($product->image_url != 'null')
                                    <img src="{{ asset("images/$product->image_url") }}" alt="" class="mx-auto"
                                        style="object-fit: cover; height:60px !important" width="50" height="60">
                                @else
                                    Chưa cập nhật
                                @endif
                            </td>
                            <td class="p-2">
                                {{-- {{ $tong = 0}} --}}
                                <?php $tong = 0; ?>
                                @foreach ($product->product_Variants as $item)
                                    <?php $tong += $item->stock; ?>
                                @endforeach
                                {{ $tong }}

                            </td>

                            <td class="p-2">
                                <button class="update_product" class="inline-block mx-1 p-1"
                                data-id="2" 
                                data-name="Máy tính Y" 
                                data-desc="Laptop hiệu Z">
                                    <i class="fas fa-pen text-red-500 cursor-pointer">
                                    </i>
                                </button>

                                <a href="{{ route('product.delete', $product->id_product) }}" class="inline-block mx-1 p-1">
                                    <i class="fas fa-trash text-red-500 cursor-pointer">
                                    </i>
                                </a>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{--  --}}
            <div class="modal"></div>
            <div class="add_product">
                <h1 class="border-bottom pb-2 mb-4 h5">Thêm mới sản phẩm</h1>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form method="POST" action="{{ route('product.postProduct') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3 text-start">
                                <div class="col-md-6">
                                    <label class="form-label">Tên sản phẩm</label>
                                    <input name="name" type="text" class="form-control form-control-sm" id="name"/>
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
                                        {{-- @foreach ($category as $categies)
                                                                <option value="{{ $categies->id_category }}">{{ $categies->name }}</option>
                                                            @endforeach --}}
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
                                        <input name="is_featured" type="checkbox" class="form-check-input"
                                            id="isFeatured">
                                        <label class="form-check-label" for="isFeatured">Nổi bật</label>
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" style="border:1px solid black; box-shadow:1px 1px 1px black"
                                        class="btn btn-primary btn-sm">Thêm mới</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{ $products->links() }}
        </div>
    </div>
@endsection
