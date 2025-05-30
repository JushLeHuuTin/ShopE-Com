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
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h1 class="border-bottom pb-2 mb-4 h5">Danh Sách Sản Phẩm</h1>

        @if(isset($products) && $products->total() > 0)
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
                                @if ($product->category)
                                    {{ $product->category->name }}
                                @else
                                    Danh mục đã xoá
                                @endif
                            </td>
                            <td class="p-2">
                                @if ($product->image_url && file_exists(public_path("images/$product->image_url")))
                                    <img src="{{ asset("images/$product->image_url") }}" class="display_img mx-auto h-auto"
                                        style="object-fit: cover;" width="50" alt="">
                                @else
                                    <img src="{{ asset('images/logo.png') }}" class="display_img mx-auto h-auto"
                                        style="object-fit: cover; " width="50" alt="Chưa cập nhật">
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
                                <a href="{{ route('product.edit', $product->id_product) }}" class="update_product"
                                    class="inline-block mx-1 p-1">
                                    <i class="fas fa-pen text-red-500 cursor-pointer">
                                    </i>
                                </a>

                                <a href="{{ route('product.delete', $product->id_product) }}" class="inline-block mx-1 p-1"
                                    onclick="return confirm('Bạn có chắc muốn xoá sản phẩm ?')">
                                    <i class="fas fa-trash text-red-500 cursor-pointer">
                                    </i>
                                </a>

                            </td>

                        </tr>
                    @endforeach
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
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
        @else
        Trống
        @endif
    </div>
@endsection
