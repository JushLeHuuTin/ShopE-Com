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

        <div class="row justify-content-center">
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
                                {{ $name = Str::words($product->name, 8, '...');}}
                            </td>
                            <td class="p-2">
                                @if (isset($product->defaultVariant->price))
                                    {{ number_format($product->defaultVariant->price, 0, ',', '.') }}₫
                                @else
                                    Chưa cập nhật
                                @endif
                            </td>
                            <td class="p-2">
                              
                            </td>
                            <td class="p-2">
                                @if ($product->image_url != 'null')
                                    <img src="{{ asset("images/$product->image_url") }}" alt="" class=""
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
                                <a href="" class="inline-block mx-1 p-1" >
                                    <i class="fas fa-pen text-red-500 cursor-pointer">
                                    </i>
                                </a>
                                <a href="{{ route('product.delete',$product->id_product) }}" class="inline-block mx-1 p-1" >
                                    <i class="fas fa-trash text-red-500 cursor-pointer">
                                    </i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
@endsection
