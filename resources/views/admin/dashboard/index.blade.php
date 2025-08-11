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

    <!-- New Order Notification Modal -->
    <div id="newOrderModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 rounded-t dark:border-gray-700">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        Pesanan Baru Masuk!
                    </h3>
                    <button type="button" id="closeModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 text-center">
                    <div class="w-12 h-12 rounded-full bg-green-100 p-2 flex items-center justify-center mx-auto mb-3.5 dark:bg-green-900">
                        <svg class="w-6 h-6 text-green-500 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="mb-4 text-lg font-semibold text-gray-900 dark:text-white" id="modal-title-count">Pesanan baru telah masuk!</p>
                    <div id="newOrderDetails" class="text-gray-500 mb-6 text-sm dark:text-gray-400">
                        <!-- Order details will be populated here -->
                    </div>
                    <div class="flex gap-3 justify-center">
                        <a href="{{ route('admin.orders.index') }}" 
                            class="text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Lihat Pesanan
                        </a>
                        <button type="button" id="closeModalSecondary"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Tutup
                        </button>
                    </div>
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

            // New Order Notification System
            let lastOrderCheck = @json($lastOrderCheck);
            let checkInterval;

            function playNotificationSound() {
                // Create notification sound
                const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSsFJHfH8N2QQAoUXrTp66hVFApGn+DyvmEcBjiS1/7MeSsFJH');
                audio.volume = 0.3;
                audio.play().catch(e => console.log('Could not play sound:', e));
            }

            function checkForNewOrders() {
                console.log('Checking for new orders...', {
                    lastOrderCheck: lastOrderCheck,
                    url: '{{ route('admin.dashboard.check-new-orders') }}'
                });

                fetch('{{ route('admin.dashboard.check-new-orders') }}?last_check=' + encodeURIComponent(lastOrderCheck), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    
                    if (data.success && data.count > 0) {
                        console.log('New orders found:', data.count);
                        showNewOrderModal(data.new_orders);
                        playNotificationSound();
                        updateStatistics();
                        
                        // Trigger notification dot in the navbar
                        if (typeof window.triggerNotificationDot === 'function') {
                            window.triggerNotificationDot();
                        }
                    } else {
                        console.log('No new orders found');
                    }
                    
                    // Update last check time
                    if (data.current_time) {
                        lastOrderCheck = data.current_time;
                        console.log('Updated lastOrderCheck to:', lastOrderCheck);
                    }
                })
                .catch(error => {
                    console.error('Error checking for new orders:', error);
                });
            }

            function showNewOrderModal(orders) {
                const modal = document.getElementById('newOrderModal');
                const detailsContainer = document.getElementById('newOrderDetails');
                const titleCount = document.getElementById('modal-title-count');
                
                // Update title based on order count
                if (orders.length === 1) {
                    titleCount.textContent = 'Ada pesanan baru yang masuk!';
                } else {
                    titleCount.textContent = `Ada ${orders.length} pesanan baru yang masuk!`;
                }
                
                let ordersHtml = '';
                orders.forEach((order, index) => {
                    const serviceTypeIcon = order.service_type === 'Sewa Mobil' ? '🚗' : '🗺️';
                    const serviceTypeBadge = order.service_type === 'Sewa Mobil' 
                        ? '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">🚗 Sewa Mobil</span>'
                        : '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">🗺️ Paket Tour</span>';
                    
                    ordersHtml += `
                        <div class="bg-gray-50 rounded-lg p-3 mb-3 last:mb-0 dark:bg-gray-700">
                            <div class="text-center">
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-2">
                                    ${serviceTypeIcon} Pesanan #${order.order_number}
                                </h4>
                                <div class="space-y-1 text-xs text-gray-600 dark:text-gray-300">
                                    <p><span class="font-medium">Pelanggan:</span> ${order.customer_name}</p>
                                    <p><span class="font-medium">Layanan:</span> ${order.service_title}</p>
                                    <p>${serviceTypeBadge}</p>
                                    <p><span class="font-medium">Total:</span> <span class="text-green-600 dark:text-green-400 font-semibold">${order.formatted_amount}</span></p>
                                    <p class="text-gray-500 dark:text-gray-400">${order.time_ago}</p>
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                detailsContainer.innerHTML = ordersHtml;
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function updateStatistics() {
                // Reload the page to update statistics
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            }

            // Modal close functionality
            function closeModal() {
                const modal = document.getElementById('newOrderModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            document.getElementById('closeModal').addEventListener('click', closeModal);
            document.getElementById('closeModalSecondary').addEventListener('click', closeModal);

            // Close modal when clicking outside
            document.getElementById('newOrderModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });

            // Start checking for new orders every 10 seconds (for better responsiveness)
            checkInterval = setInterval(checkForNewOrders, 10000);

            // Check immediately when page loads
            setTimeout(checkForNewOrders, 2000);

            // Debug functions (only for development)
            window.debugCheckOrders = function() {
                console.log('Manual check triggered');
                checkForNewOrders();
            };

            window.debugResetCheck = function() {
                fetch('{{ route('admin.dashboard.reset-order-check') }}')
                    .then(response => response.json())
                    .then(data => {
                        console.log('Reset response:', data);
                        if (data.success) {
                            lastOrderCheck = data.last_check;
                            console.log('Check time reset to:', lastOrderCheck);
                            alert('Check time reset successfully! Next check will look for orders from 1 hour ago.');
                        }
                    })
                    .catch(error => console.error('Reset error:', error));
            };

            window.debugShowTestModal = function() {
                const testOrders = [{
                    id: 999,
                    customer_name: 'Test Customer',
                    service_title: 'Test Service',
                    service_type: 'Sewa Mobil',
                    formatted_amount: 'Rp 1.000.000',
                    order_number: 'MST999',
                    time_ago: 'just now'
                }];
                showNewOrderModal(testOrders);
                
                // Also trigger notification dot
                if (typeof window.triggerNotificationDot === 'function') {
                    window.triggerNotificationDot();
                }
            };

            window.debugTriggerDot = function() {
                if (typeof window.triggerNotificationDot === 'function') {
                    window.triggerNotificationDot();
                    console.log('Notification dot triggered manually');
                } else {
                    console.log('triggerNotificationDot function not available');
                }
            };

            // Clear interval when page is about to unload
            window.addEventListener('beforeunload', function() {
                if (checkInterval) {
                    clearInterval(checkInterval);
                }
            });
        </script>
    @endpush
@endsection
