@extends('layouts.admin_layout')

@section('content')
    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard.index') }}"
                                class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500"
                                    aria-current="page">Pesanan</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Manajemen Pesanan</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Kelola semua pesanan dari pelanggan</p>
            </div>
            <div class="sm:flex">
                <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                    <form class="lg:pr-3" action="{{ route('admin.orders.index') }}" method="GET" id="search-form">
                        <label for="orders-search" class="sr-only">Search</label>
                        <div class="relative mt-1 lg:w-64 xl:w-96">
                            <input type="text" name="search" id="orders-search" value="{{ request('search') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Cari nama, email, atau WhatsApp...">
                            <input type="hidden" name="status" value="{{ request('status') }}">
                        </div>
                    </form>
                    <div class="flex pl-0 mt-3 space-x-1 sm:pl-2 sm:mt-0">
                        <form action="{{ route('admin.orders.index') }}" method="GET" id="filter-form">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <select name="status" id="status-filter"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>
                                    Dikonfirmasi</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai
                                </option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                    Dibatalkan</option>
                            </select>
                        </form>
                        <button type="button" onclick="clearFilters()"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm px-3 py-2 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                            Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col min-h-[80vh]">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    ID Pesanan
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Nama Pelanggan
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Layanan
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Tanggal
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Total Harga
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Status
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse($orders as $order)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        <div class="text-base font-semibold text-gray-900 dark:text-white">
                                            #MST{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</div>
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            <div class="text-base font-semibold text-gray-900 dark:text-white">
                                                {{ $order->name }}</div>
                                            <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                                {{ $order->email }}</div>
                                            <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                                {{ $order->whatsapp_number }}</div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            <div class="text-base font-semibold text-gray-900 dark:text-white">
                                                @if ($order->variant)
                                                    {{ $order->service->title ?? 'Layanan Tidak Ditemukan' }} | {{ $order->variant->name }}
                                                @else
                                                    {{ $order->service->title ?? 'Layanan Tidak Ditemukan' }}
                                                @endif
                                            </div>
                                            <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                                {{ $order->number_of_participants }} Peserta</div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            <div class="text-base font-semibold text-gray-900 dark:text-white">
                                                {{ $order->formatted_start_date }}</div>
                                            <div class="text-sm font-normal text-gray-500 dark:text-gray-400">s/d
                                                {{ $order->formatted_end_date }} ({{ $order->duration }} hari)</div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        @php
                                            $basePrice = 0;
                                            if ($order->variant) {
                                                $basePrice = $order->variant->price;
                                            } elseif ($order->service) {
                                                $basePrice = $order->service->price;
                                            }
                                            $totalPrice = $basePrice * $order->duration * $order->number_of_participants;
                                        @endphp
                                        
                                        @if ($basePrice > 0)
                                            <div class="text-lg font-bold text-blue-600 dark:text-blue-400">
                                                Rp {{ number_format($totalPrice, 0, ',', '.') }}
                                            </div>
                                        @else
                                            <div class="text-sm text-gray-500 dark:text-gray-400">-</div>
                                        @endif
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <span
                                            class="{{ $order->status == 'pending'
                                                ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300'
                                                : ($order->status == 'confirmed'
                                                    ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'
                                                    : ($order->status == 'completed'
                                                        ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300'
                                                        : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300')) }} text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                            {{ $order->status_text }}
                                        </span>
                                    </td>
                                    <td class="p-4 space-x-2 whitespace-nowrap">
                                        <button onclick="openOrderDetail({{ $order->id }})" type="button"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                <path fill-rule="evenodd"
                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Detail
                                        </button>
                                        <button
                                            onclick="chatWhatsApp('{{ $order->clean_whatsapp_number }}', '{{ $order->name }}', 'MST{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}')"
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                                            </svg>
                                            Chat
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-4 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada data pesanan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if ($orders->hasPages())
            <div class="p-4 bg-white border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                {{ $orders->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Overlay -->
    <div id="modal-overlay" class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 dark:bg-opacity-80 hidden"></div>

    <!-- Order Detail Modal -->
    <div id="order-detail-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <!-- Modal content -->
            <div
                class="relative bg-white rounded-lg shadow-xl border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 rounded-t dark:border-gray-700">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                            Detail Pesanan
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Informasi lengkap pesanan pelanggan</p>
                    </div>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        onclick="hideModal('order-detail-modal')">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <div class="space-y-6" id="modal-content">
                        <!-- Content will be loaded here -->
                        <div class="flex justify-center items-center py-8">
                            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary-600"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            // Search and Filter functionality
            document.getElementById('orders-search').addEventListener('input', function() {
                clearTimeout(this.searchTimeout);
                this.searchTimeout = setTimeout(() => {
                    document.getElementById('search-form').submit();
                }, 500);
            });

            document.getElementById('status-filter').addEventListener('change', function() {
                document.getElementById('filter-form').submit();
            });

            function clearFilters() {
                window.location.href = '{{ route('admin.orders.index') }}';
            }

            // Function to open order detail modal
            function openOrderDetail(orderId) {
                showModal('order-detail-modal');

                // Show loading
                document.getElementById('modal-content').innerHTML = `
                    <div class="flex justify-center items-center py-8">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary-600"></div>
                    </div>
                `;

                // Fetch order data using the corrected URL
                fetch(`/admin/orders/${orderId}/ajax`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            displayOrderDetail(data.data);
                        } else {
                            document.getElementById('modal-content').innerHTML = `
                                <div class="text-center py-8">
                                    <p class="text-red-500">Error: ${data.message}</p>
                                </div>
                            `;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('modal-content').innerHTML = `
                            <div class="text-center py-8">
                                <p class="text-red-500">Terjadi kesalahan saat memuat data: ${error.message}</p>
                            </div>
                        `;
                    });
            }

            // Function to display order detail
            function displayOrderDetail(order) {
                const orderIdFormatted = `MST${String(order.id).padStart(3, '0')}`;

                document.getElementById('modal-content').innerHTML = `
                    <!-- Order ID and Status -->
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white">ID Pesanan: #${orderIdFormatted}</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal Pesanan: ${formatDate(order.created_at)}</p>
                        </div>
                        <span class="${getStatusClass(order.status)}">
                            ${order.status_text}
                        </span>
                    </div>

                    <!-- Customer Information -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h5 class="text-md font-semibold text-gray-900 dark:text-white mb-3">Informasi Pelanggan</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Lengkap</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">${order.name}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">${order.email}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nomor WhatsApp</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">${order.whatsapp_number}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">Format internasional: +${order.clean_whatsapp_number}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Jumlah Peserta</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">${order.number_of_participants} orang</p>
                            </div>
                        </div>
                    </div>

                    <!-- Service Information -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h5 class="text-md font-semibold text-gray-900 dark:text-white mb-3">Informasi Layanan</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Jenis Layanan</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">${order.display_title || 'Layanan Tidak Ditemukan'}</p>
                                ${order.variant ? '<p class="text-xs text-gray-400 dark:text-gray-500">Varian: ' + order.variant.name + '</p>' : ''}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Lokasi Pickup</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">${order.pickup_location}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Mulai</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">${order.formatted_start_date}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Selesai</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">${order.formatted_end_date}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h5 class="text-md font-semibold text-gray-900 dark:text-white mb-3">Informasi Tambahan</h5>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pesan Pelanggan</p>
                            <p class="text-base text-gray-900 dark:text-white">${order.message || 'Tidak ada pesan'}</p>
                        </div>
                    </div>

                    <!-- Price Information -->
                    <div class="border-t border-gray-200 dark:border-gray-600 pt-4">
                        <div class="flex justify-between items-center">
                            <p class="text-lg font-bold text-gray-900 dark:text-white">Total Harga</p>
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">Rp ${formatNumber(order.total_price)}</p>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">${order.duration} hari × Rp ${formatNumber(order.display_price || 0)} × ${order.number_of_participants} peserta</p>
                        ${order.variant ? '<p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Menggunakan harga varian: ' + order.variant.name + '</p>' : ''}
                    </div>

                    <!-- Status Update Section -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                        <h5 class="text-md font-semibold text-gray-900 dark:text-white mb-3">Update Status Pesanan</h5>
                        <div class="flex gap-3 items-center">
                            <select id="modal-status-select" data-order-id="${order.id}"
                                class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="pending" ${order.status === 'pending' ? 'selected' : ''}>Pending</option>
                                <option value="confirmed" ${order.status === 'confirmed' ? 'selected' : ''}>Dikonfirmasi</option>
                                <option value="completed" ${order.status === 'completed' ? 'selected' : ''}>Selesai</option>
                                <option value="cancelled" ${order.status === 'cancelled' ? 'selected' : ''}>Dibatalkan</option>
                            </select>
                            <button onclick="updateOrderStatus(${order.id})" type="button" id="update-status-btn"
                                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <span class="btn-text">Update Status</span>
                                <div class="btn-loading hidden">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Updating...
                                </div>
                            </button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                        <button onclick="chatWhatsApp('${order.clean_whatsapp_number}', '${order.name}', '${orderIdFormatted}')" type="button"
                            class="flex-1 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="w-4 h-4 mr-2 inline" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                    </svg>
                    Chat WhatsApp
                </button>
                <button onclick="hideModal('order-detail-modal')" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm px-5 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                    Tutup
                </button>
            </div>
        `;
            }

            // Function to update order status
            function updateOrderStatus(orderId) {
                console.log('Updating order status for ID:', orderId); // Debug log

                const statusSelect = document.getElementById('modal-status-select');
                const updateBtn = document.getElementById('update-status-btn');
                const btnText = updateBtn.querySelector('.btn-text');
                const btnLoading = updateBtn.querySelector('.btn-loading');
                const newStatus = statusSelect.value;

                console.log('New status:', newStatus); // Debug log

                // Check if CSRF token exists
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (!csrfToken) {
                    console.error('CSRF token not found');
                    showNotification('CSRF token tidak ditemukan. Refresh halaman dan coba lagi.', 'error');
                    return;
                }

                console.log('CSRF Token:', csrfToken.getAttribute('content')); // Debug log

                // Show loading state
                btnText.classList.add('hidden');
                btnLoading.classList.remove('hidden');
                updateBtn.disabled = true;
                statusSelect.disabled = true;

                const url = `/admin/orders/${orderId}/status`;
                console.log('Request URL:', url); // Debug log

                fetch(url, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            status: newStatus
                        })
                    })
                    .then(response => {
                        console.log('Response status:', response.status); // Debug log
                        console.log('Response headers:', response.headers); // Debug log

                        if (!response.ok) {
                            return response.text().then(text => {
                                console.error('Response text:', text);
                                throw new Error(`HTTP error! status: ${response.status}, response: ${text}`);
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data); // Debug log

                        if (data.success) {
                            // Show success message
                            showNotification('Status pesanan berhasil diperbarui!', 'success');

                            // Update the status badge in modal
                            const statusBadge = document.querySelector(
                                '.bg-yellow-100, .bg-green-100, .bg-blue-100, .bg-red-100');
                            if (statusBadge) {
                                statusBadge.className = getStatusClass(newStatus);
                                statusBadge.textContent = data.data.status_text;
                            }

                            // Reload the page after 1 second to reflect changes in table
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            showNotification('Error: ' + data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        showNotification('Terjadi kesalahan saat memperbarui status: ' + error.message, 'error');
                    })
                    .finally(() => {
                        // Reset button state
                        btnText.classList.remove('hidden');
                        btnLoading.classList.add('hidden');
                        updateBtn.disabled = false;
                        statusSelect.disabled = false;
                    });
            }

            // Check CSRF token on page load
            document.addEventListener('DOMContentLoaded', function() {
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                if (!csrfToken) {
                    console.error('CSRF meta tag not found in document head');
                    showNotification('CSRF token tidak ditemukan. Silakan refresh halaman.', 'error');
                } else {
                    console.log('CSRF token found:', csrfToken.getAttribute('content'));
                }
            });

            // Function to show notification
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm ${
            type === 'success' ? 'bg-green-500 text-white' : 
            type === 'error' ? 'bg-red-500 text-white' : 
            'bg-blue-500 text-white'
        }`;
                notification.textContent = message;

                document.body.appendChild(notification);

                // Auto remove after 3 seconds
                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }

            // Function to chat via WhatsApp with proper formatting
            function chatWhatsApp(phoneNumber, customerName, orderId) {
                console.log('WhatsApp Number:', phoneNumber); // Debug log
                const message =
                    `Halo ${customerName}, terima kasih telah memesan layanan Mega Santosa Tour dengan ID pesanan #${orderId}. Ada yang bisa kami bantu?`;
                const encodedMessage = encodeURIComponent(message);
                const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
                console.log('WhatsApp URL:', whatsappUrl); // Debug log
                window.open(whatsappUrl, '_blank');
            }

            // Helper functions
            function getStatusClass(status) {
                const classMap = {
                    'pending': 'bg-yellow-100 text-yellow-800 text-sm font-medium px-3 py-1 rounded-full dark:bg-yellow-900 dark:text-yellow-300',
                    'confirmed': 'bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full dark:bg-green-900 dark:text-green-300',
                    'completed': 'bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full dark:bg-blue-900 dark:text-blue-300',
                    'cancelled': 'bg-red-100 text-red-800 text-sm font-medium px-3 py-1 rounded-full dark:bg-red-900 dark:text-red-300'
                };
                return classMap[status] || classMap['pending'];
            }

            function formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
            }

            function formatNumber(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }

            // Modal helper functions
            function showModal(modalId) {
                const modal = document.getElementById(modalId);
                const overlay = document.getElementById('modal-overlay');

                if (modal && overlay) {
                    overlay.classList.remove('hidden');
                    overlay.classList.add('block');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    document.body.style.overflow = 'hidden';
                }
            }

            function hideModal(modalId) {
                const modal = document.getElementById(modalId);
                const overlay = document.getElementById('modal-overlay');

                if (modal && overlay) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    overlay.classList.add('hidden');
                    overlay.classList.remove('block');
                    document.body.style.overflow = 'auto';
                }
            }

            // Handle modal backdrop clicks
            document.getElementById('modal-overlay').addEventListener('click', function() {
                hideModal('order-detail-modal');
            });

            document.getElementById('order-detail-modal').addEventListener('click', function(e) {
                if (e.target === this) {
                    hideModal('order-detail-modal');
                }
            });

            // Handle escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    hideModal('order-detail-modal');
                }
            });
        </script>
    @endpush
@endsection
