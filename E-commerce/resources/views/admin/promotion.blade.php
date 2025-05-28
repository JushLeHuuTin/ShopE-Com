@php
    use Carbon\Carbon;
@endphp
@extends('layout.admin')

@section('title', 'Quản lý promotion')

@section('content')
    <div class=" h-100 position-relative">

        <h2 class="text-xl font-bold mb-4">
            Danh sách mã giảm giá
        </h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <table class="w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-green-500 text-white">
                    <th class="p-2">
                        Tên chương trình
                        
                    </th>
                    <th class="p-2">
                        Phần trăm giảm
                    </th>
                    <th class="p-2">
                        Ngày bắt đầu
                    </th>
                    <th class="p-2">
                        Ngày kết thúc
                    </th>
                    <th class="p-2">
                        Trạng thái
                    </th>
                    <th class="p-2">
                        Hành động
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($promotions as $promotion)
                    <tr class="border-b">
                        <td class="p-2">
                            <a href="{{ route('promotion.products',$promotion->id_promotion) }}">
                                {{ $promotion->name }}
                            </a>
                        </td>
                        <td class="p-2">
                            {{ $promotion->discount_value }}
                            %

                        </td>
                        <td class="p-2">
                            {{ $promotion->start_date }}

                        </td>
                        <td class="p-2">
                            {{ $promotion->end_date }}
                        </td>
                        <td class="p-2">
                            <span class="bg-green-500 text-white rounded px-2 py-1">
                                @if (Carbon::parse($promotion->end_date)->isFuture())
                                    <span class="">Còn hạn</span>
                                @else
                                    <span class="">Hết hạn</span>
                                @endif
                            </span>
                        </td>
                        <td class="p-2 flex space-x-2">
                            <a href="{{ route('promotion.update', $promotion->id_promotion) }}">

                                <i class="fas fa-pen text-red-500 cursor-pointer">
                                </i>
                            </a>
                            <a href="{{ route('promotion.delete', $promotion->id_promotion) }}" class="delete-promotion">
                                <i class="fas fa-trash text-red-500 cursor-pointer">
                                </i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <p>Không có mã giảm giá.</p>
                @endforelse
            </tbody>
        </table>
        <div class=" mt-4">
            {{ $promotions->links() }}
        </div>
    </div>
@endsection
