@extends('layout.admin')

@section('title', 'Thêm Danh Mục')

@section('content')
<div class="container mt-4">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h1 class="border-bottom pb-2 mb-4 h5">Thêm Danh Mục</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('category.store') }}">
                @csrf
                <div class="row g-3">

                    {{-- Tên danh mục --}}
                    <div class="col-12">
                        <label class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                        <input name="name" type="text" class="form-control form-control-sm"
                            value="{{ old('name') }}" required />
                        @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div class="col-12">
                        <label class="form-label">Slug <span class="text-danger">*</span></label>
                        <input name="slug" type="text" class="form-control form-control-sm"
                            value="{{ old('slug') }}" required />
                        @error('slug')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-submit btn-primary btn-sm"
                            style="border:1px solid black; box-shadow:1px 1px 1px black">
                            Thêm mới
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
