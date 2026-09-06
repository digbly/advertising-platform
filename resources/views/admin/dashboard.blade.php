@extends('layouts.admin')

@section('title', 'Dashboard - ' . config('app.name'))

@section('page-title', __('Dashboard'))

@section('content')
    {{-- Page header --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ __('Tổng quan') }}</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Chào mừng trở lại! Đây là tổng quan hoạt động của bạn hôm nay.') }}</p>
        </div>
        <div class="flex items-center gap-2">
            <button type="button"
                class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                {{ __('Xuất báo cáo') }}
            </button>
            <button type="button"
                class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-indigo-500">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                {{ __('Tạo mới') }}
            </button>
        </div>
    </div>

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            ['label' => __('Doanh thu'), 'value' => '₫ 128,500,000', 'change' => '+12.5%', 'up' => true, 'color' => 'bg-indigo-500'],
            ['label' => __('Người dùng'), 'value' => '2,847', 'change' => '+8.2%', 'up' => true, 'color' => 'bg-emerald-500'],
            ['label' => __('Liên hệ mới'), 'value' => '156', 'change' => '-3.1%', 'up' => false, 'color' => 'bg-amber-500'],
            ['label' => __('Đơn hàng'), 'value' => '1,024', 'change' => '+5.4%', 'up' => true, 'color' => 'bg-rose-500'],
        ] as $stat)
            <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $stat['label'] }}</p>
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg {{ $stat['color'] }} text-white">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        </svg>
                    </span>
                </div>
                <p class="mt-3 text-2xl font-bold text-gray-900 dark:text-white">{{ $stat['value'] }}</p>
                <p class="mt-1 text-xs">
                    <span @class(['font-semibold', 'text-emerald-600 dark:text-emerald-400' => $stat['up'], 'text-red-600 dark:text-red-400' => !$stat['up']])>{{ $stat['change'] }}</span>
                    <span class="text-gray-400 dark:text-gray-500"> {{ __('so với tháng trước') }}</span>
                </p>
            </div>
        @endforeach
    </div>

    {{-- Chart + activity --}}
    <div class="mt-6 grid grid-cols-1 gap-4 lg:grid-cols-3">
        {{-- Chart placeholder --}}
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm lg:col-span-2 dark:border-gray-800 dark:bg-gray-900">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ __('Biểu đồ doanh thu') }}</h3>
                <select class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200">
                    <option>{{ __('7 ngày') }}</option>
                    <option>{{ __('30 ngày') }}</option>
                    <option>{{ __('12 tháng') }}</option>
                </select>
            </div>
            <div class="flex h-64 items-end gap-2">
                @foreach ([40, 65, 50, 80, 60, 90, 75, 55, 85, 70, 95, 62] as $i => $height)
                    <div class="group relative flex-1">
                        <div class="w-full rounded-t-md bg-indigo-500/80 transition-colors group-hover:bg-indigo-500 dark:bg-indigo-500/60"
                            style="height: {{ $height }}%"></div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Recent activity --}}
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900">
            <h3 class="mb-4 text-sm font-semibold text-gray-900 dark:text-white">{{ __('Hoạt động gần đây') }}</h3>
            <ul class="space-y-4">
                @foreach ([
                    ['title' => __('Liên hệ mới từ Nguyễn Văn A'), 'time' => '2 phút trước', 'color' => 'bg-indigo-500'],
                    ['title' => __('Người dùng demo@gmail.com đăng ký'), 'time' => '1 giờ trước', 'color' => 'bg-emerald-500'],
                    ['title' => __('Cập nhật cài đặt hệ thống'), 'time' => '3 giờ trước', 'color' => 'bg-amber-500'],
                    ['title' => __('Báo cáo tuần đã được tạo'), 'time' => '1 ngày trước', 'color' => 'bg-rose-500'],
                ] as $activity)
                    <li class="flex gap-3">
                        <span class="mt-1.5 h-2 w-2 shrink-0 rounded-full {{ $activity['color'] }}"></span>
                        <div class="min-w-0">
                            <p class="truncate text-sm text-gray-700 dark:text-gray-200">{{ $activity['title'] }}</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500">{{ $activity['time'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Table --}}
    <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
        <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-800">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ __('Liên hệ gần đây') }}</h3>
            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">{{ __('Xem tất cả') }} &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                <thead class="bg-gray-50 dark:bg-gray-800/50">
                    <tr>
                        <th scope="col" class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">{{ __('Tên') }}</th>
                        <th scope="col" class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">{{ __('Email') }}</th>
                        <th scope="col" class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">{{ __('Chủ đề') }}</th>
                        <th scope="col" class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">{{ __('Trạng thái') }}</th>
                        <th scope="col" class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">{{ __('Hành động') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-800 dark:bg-gray-900">
                    @foreach ([
                        ['name' => 'Nguyễn Văn A', 'email' => 'nguyenvana@example.com', 'subject' => 'Hợp tác quảng cáo', 'status' => 'pending'],
                        ['name' => 'Trần Thị B', 'email' => 'tranthib@example.com', 'subject' => 'Báo giá banner', 'status' => 'read'],
                        ['name' => 'Lê Văn C', 'email' => 'levanc@example.com', 'subject' => 'Yêu cầu hỗ trợ', 'status' => 'resolved'],
                        ['name' => 'Phạm Thị D', 'email' => 'phamthid@example.com', 'subject' => 'Đăng ký đối tác', 'status' => 'pending'],
                    ] as $row)
                        <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="whitespace-nowrap px-5 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $row['name'] }}</td>
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $row['email'] }}</td>
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-gray-700 dark:text-gray-300">{{ $row['subject'] }}</td>
                            <td class="whitespace-nowrap px-5 py-4">
                                @php
                                    $badge = [
                                        'pending' => ['bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400', __('Chờ xử lý')],
                                        'read' => ['bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400', __('Đã đọc')],
                                        'resolved' => ['bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400', __('Đã xử lý')],
                                    ][$row['status']];
                                @endphp
                                <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ $badge[0] }}">{{ $badge[1] }}</span>
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 text-right">
                                <button type="button" class="rounded-lg px-3 py-1.5 text-sm font-medium text-indigo-600 transition-colors hover:bg-indigo-50 dark:text-indigo-400 dark:hover:bg-indigo-500/10">{{ __('Xem') }}</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
