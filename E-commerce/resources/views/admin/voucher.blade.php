@php
    use Carbon\Carbon;
@endphp
@extends('layout.admin')

@section('title', 'Quản lý Voucher')

@section('content')
    <div class="w-4/5 p-6">

        <h2 class="text-xl font-bold mb-4">
            Danh sách mã giảm giá
        </h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <table class="w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-green-500 text-white">
                    <th class="p-2">
                        Mã giảm giá
                    </th>
                    <th class="p-2">
                        Phần trăm giảm
                    </th>
                    <th class="p-2">
                        Ngày kết thúc
                    </th>
                    <th class="p-2">
                        Trạng thái
                    </th>
                    <th class="p-2">
                        Số lần sử dụng
                    </th>
                    <th class="p-2">
                        Hành động
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($vouchers as $voucher)
                    <tr class="border-b">
                        <td class="p-2">
                            {{ $voucher->code }}
                        </td>
                        <td class="p-2">
                            {{ $voucher->discount_value }}
                            %

                        </td>
                        <td class="p-2">
                            {{ $voucher->expiration_date }}

                        </td>
                        <td class="p-2">
                            <span class="bg-green-500 text-white rounded px-2 py-1">
                                @if (Carbon::parse($voucher->expiration_date)->isFuture())
                                    <span class="">Còn hạn</span>
                                @else
                                    <span class="">Hết hạn</span>
                                @endif
                            </span>
                        </td>
                        <td class="p-2">
                            20
                        </td>
                        <td class="p-2 flex space-x-2">
                            <i class="fas fa-pen text-red-500 cursor-pointer">
                            </i>
                            <a href="{{ route('voucher.delete',$voucher->id_discount) }}" class="delete-voucher">
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
    </div>
@endsection
