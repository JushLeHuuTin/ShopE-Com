<?php
use Illuminate\Support\Str;
?>
@extends('layout.admin')

@section('title', 'Quản lý Sản Phẩm')

@section('content')
<div class="container mt-4">
    <h1 class="border-bottom pb-2 mb-4 h5">Danh Sách Danh Mục</h1>

    <table class="w-full bg-white rounded shadow mb-4">
        <thead style="background: #f8f9fa;">
            <tr>
                <th class="p-2">ID</th>
                <th class="p-2">Tên danh mục</th>
                <th class="p-2">Liên kết tĩnh</th>
                <th class="p-2">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categoriess as $category)
            <tr class="border-b">
                <td class="p-2">{{ $category->id_category }}</td>
                <td class="p-2">{{ $category->name }}</td>
                <td class="p-2">{{ $category->slug }}</td>
                <td class="p-2">
                    <a href="{{ route('category.edit', $category->id_category) }}" class="mx-1 p-1 text-blue-500">
                        <i class="fas fa-pen"></i>
                    </a>
                    <a href="{{ route('category.delete', $category->id_category) }}" onclick="return confirm('Bạn có chắc muốn xoá?')" class="mx-1 p-1 text-red-500">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categoriess->links() }}
@endsection
