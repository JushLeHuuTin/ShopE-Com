@extends('layout.admin')

@section('title', 'Cập nhật danh mục')

@section('content')
    <div class="container mt-4">
        <h1 class="h4 mb-4">Cập Nhật Danh Mục</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('category.postEdit') }}" method="POST">
            @csrf
            <input type="hidden" name="updated_at" value="{{ $category->updated_at }}">
            <input type="hidden" name="id" value="{{ $category->id_category }}">

            <div class="mb-3">
                <label for="name" class="form-label">Tên danh mục</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}"
                    required>
                @if ($errors->has('name'))
                    <div class="text-danger small">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}"
                    required>
                @if ($errors->has('slug'))
                    <div class="text-danger small">{{ $errors->first('slug') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="{{ route('category.list') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
