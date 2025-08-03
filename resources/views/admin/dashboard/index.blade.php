@extends('layouts.admin_layout')

@section('content')
    <div class="px-4 pt-6 min-h-screen">
        <!-- Statistics Cards -->
        <div class="grid gap-4 grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 my-8">
            <!-- Today's Orders -->
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span
                            class="text-2xl font-bold leading-none text-gray-900 dark:text-white">{{ $todayOrders }}</span>
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Pesanan Hari Ini</h3>
                    </div>
                    <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            {{-- <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="text-2xl font-bold leading-none text-gray-900 dark:text-white">Rp
                            {{ number_format($totalRevenue, 0, ',', '.') }}</span>
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Total Pendapatan</h3>
                    </div>
                    <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div> --}}

            <!-- Sewa Mobil Orders -->
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span
                            class="text-2xl font-bold leading-none text-gray-900 dark:text-white">{{ $serviceTypeStats['sewa_mobil'] }}</span>
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Sewa Mobil</h3>
                    </div>
                    <div class="ml-5 w-0 flex items-center justify-end flex-1 text-blue-500 text-base font-bold">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Paket Tour Orders -->
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span
                            class="text-2xl font-bold leading-none text-gray-900 dark:text-white">{{ $serviceTypeStats['paket_tour'] }}</span>
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Paket Tour</h3>
                    </div>
                    <div class="ml-5 w-0 flex items-center justify-end flex-1 text-purple-500 text-base font-bold">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Chart Widget -->
        {{-- <div class="grid gap-4 grid-cols-1 my-8">
            <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">Statistik Pemesanan</h2>

            <div
                class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0">
                        <span
                            class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">{{ $todayOrders + $serviceTypeStats['sewa_mobil'] + $serviceTypeStats['paket_tour'] }}</span>
                        <h3 class="text-base font-light text-gray-500 dark:text-gray-400">Total Pemesanan Minggu Ini</h3>
                    </div>
                    <div
                        class="flex items-center justify-end flex-1 text-base font-medium text-green-500 dark:text-green-400">
                        {{ $weeklyComparison['percentage_change'] }}%
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="{{ $weeklyComparison['is_increase'] ? 'M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z' : 'M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z' }}"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <div id="main-chart"></div>
                <!-- Card Footer -->
                <div
                    class="flex items-center justify-between pt-3 mt-4 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
                    <div>
                        <button
                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                            type="button">
                            7 Hari Terakhir
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ route('admin.orders.index') }}"
                            class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
                            Lihat Semua Pesanan
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Recent Orders Table -->
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <!-- Card header -->
            <div class="items-center justify-between lg:flex">
                <div class="mb-4 lg:mb-0">
                    <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Pesanan Terbaru</h3>
                    <span class="text-base font-normal text-gray-500 dark:text-gray-400">Daftar pesanan terbaru dari
                        pelanggan</span>
                </div>
                <div class="items-center sm:flex">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-blue-600 rounded mr-2"></div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Sewa Mobil</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-purple-600 rounded mr-2"></div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Paket Tour</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class="flex flex-col mt-6">
                <div class="overflow-x-auto rounded-lg">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden shadow sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col"
                                            class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                            ID Pesanan
                                        </th>
                                        <th scope="col"
                                            class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                            Pelanggan & Layanan
                                        </th>
                                        <th scope="col"
                                            class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                            Tanggal
                                        </th>
                                        <th scope="col"
                                            class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                            Total
                                        </th>
                                        <th scope="col"
                                            class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800">
                                    @forelse($recentOrders as $order)
                                        <tr class="{{ $loop->even ? 'bg-gray-50 dark:bg-gray-700' : '' }}">
                                            <td
                                                class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                                #{{ $order['order_number'] }}
                                            </td>
                                            <td
                                                class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                                <div class="text-base font-semibold">{{ $order['customer_name'] }}</div>
                                                <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                                    {{ $order['service_title'] }}</div>
                                            </td>
                                            <td
                                                class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{ $order['formatted_date'] }}
                                            </td>
                                            <td
                                                class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                                Rp {{ number_format($order['amount'], 0, ',', '.') }}
                                            </td>
                                            <td class="p-4 whitespace-nowrap">
                                                <span class="{{ $order['status_class'] }}">
                                                    {{ $order['status_text'] }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="p-4 text-center text-gray-500 dark:text-gray-400">
                                                Belum ada pesanan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card Footer -->
            <div class="flex items-center justify-between pt-3 sm:pt-6">
                <div></div>
                <div class="flex-shrink-0">
                    <a href="{{ route('admin.orders.index') }}"
                        class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
                        Lihat Semua Pesanan
                        <svg class="w-4 h-4 ml-1 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            // Chart data from PHP
            const chartData = @json($chartData);

            const options = {
                chart: {
                    height: "100%",
                    maxWidth: "100%",
                    type: "area",
                    fontFamily: "Inter, sans-serif",
                    dropShadow: {
                        enabled: false,
                    },
                    toolbar: {
                        show: false,
                    },
                },
                tooltip: {
                    enabled: true,
                    x: {
                        show: false,
                    },
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        opacityFrom: 0.55,
                        opacityTo: 0,
                        shade: "#1C64F2",
                        gradientToColors: ["#1C64F2"],
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 6,
                },
                grid: {
                    show: false,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: 0
                    },
                },
                series: [{
                        name: "Sewa Mobil",
                        data: chartData.sewa_mobil,
                        color: "#1A56DB",
                    },
                    {
                        name: "Paket Tour",
                        data: chartData.paket_tour,
                        color: "#7C3AED",
                    }
                ],
                xaxis: {
                    categories: chartData.dates,
                    labels: {
                        show: true,
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                    show: true,
                    labels: {
                        formatter: function(value) {
                            return value + ' pesanan';
                        }
                    }
                },
            }

            if (document.getElementById("main-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("main-chart"), options);
                chart.render();
            }
        </script>
    @endpush
@endsection
