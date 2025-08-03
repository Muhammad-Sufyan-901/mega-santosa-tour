<!-- Booking Form Modal -->
<div id="booking-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-5xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow border border-gray-200">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 rounded-t">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">
                        Booking Detail
                    </h3>

                    <p class="text-sm text-gray-500">Silahkan isi form dibawah ini untuk memulai booking.</p>
                </div>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="booking-modal">
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
                <form id="booking-form" class="space-y-4">
                    <input type="hidden" name="service-id" id="service-id" value="">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="full-name" class="block mb-2 text-sm font-medium text-gray-900">Nama
                                Lengkap</label>
                            <input type="text" name="full-name" id="full-name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Masukkan nama lengkap" required />
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="nama@email.com" required />
                        </div>
                        <div>
                            <label for="whatsapp" class="block mb-2 text-sm font-medium text-gray-900">Nomor
                                WhatsApp</label>
                            <input type="tel" name="whatsapp" id="whatsapp"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="08xxxxxxxxxx" required />
                        </div>
                        <div>
                            <label for="participants" class="block mb-2 text-sm font-medium text-gray-900">Jumlah
                                Peserta</label>
                            <input type="number" name="participants" id="participants" min="1" value="1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="pickup-location" class="block mb-2 text-sm font-medium text-gray-900">Lokasi
                                Pickup</label>
                            <input type="text" name="pickup-location" id="pickup-location"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Alamat lengkap pickup" required />
                        </div>
                        <div>
                            <label for="service-type" class="block mb-2 text-sm font-medium text-gray-900">Jenis Sewa
                                Mobil / Paket Tour</label>
                            <select name="service-type" id="service-type"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required>
                                <option value="" disabled selected>Pilih jenis layanan</option>
                                @php
                                    $services = \App\Models\Service::where('status', 'active')->get();
                                @endphp
                                <optgroup label="Sewa Mobil">
                                    @foreach ($services->where('type_of_service', 'Sewa Mobil') as $service)
                                        <option value="{{ $service->id }}" data-type="car"
                                            data-price="{{ $service->price }}">{{ $service->title }} - Rp
                                            {{ number_format($service->price, 0, ',', '.') }}/hari</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Paket Tour">
                                    @foreach ($services->where('type_of_service', 'Paket Tour') as $service)
                                        <option value="{{ $service->id }}" data-type="tour"
                                            data-price="{{ $service->price }}">{{ $service->title }} - Rp
                                            {{ number_format($service->price, 0, ',', '.') }}/hari</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div>
                            <label for="start-date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                                Mulai</label>
                            <input type="date" name="start-date" id="start-date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="end-date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                                Selesai</label>
                            <input type="date" name="end-date" id="end-date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                    </div>
                    <div>
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Pesan
                            (Opsional)</label>
                        <textarea name="message" id="message" rows="4"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Masukkan pesan atau permintaan khusus"></textarea>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Lanjutkan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmation-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-5xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow border border-gray-200">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 rounded-t">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">
                        Konfirmasi Pemesanan
                    </h3>

                    <p class="text-sm text-gray-500">Mohon diperiksa kembali sebelum melakukan pemesanan. Pastikan
                        semua informasi sudah benar.</p>
                </div>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="confirmation-modal">
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
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-gray-900">Rincian Pemesanan</h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nama Lengkap</p>
                            <p id="confirm-full-name" class="text-base font-semibold text-gray-900">-</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <p id="confirm-email" class="text-base font-semibold text-gray-900">-</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nomor WhatsApp</p>
                            <p id="confirm-whatsapp" class="text-base font-semibold text-gray-900">-</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Jumlah Peserta</p>
                            <p id="confirm-participants" class="text-base font-semibold text-gray-900">-</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Lokasi Pickup</p>
                            <p id="confirm-pickup" class="text-base font-semibold text-gray-900">-</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Jenis Layanan</p>
                            <p id="confirm-service" class="text-base font-semibold text-gray-900">-</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tanggal Booking</p>
                            <p id="confirm-dates" class="text-base font-semibold text-gray-900">-</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pesan</p>
                            <p id="confirm-message" class="text-base font-semibold text-gray-900">-</p>
                        </div>
                    </div>

                    <div class="mt-6 border-t border-gray-200 pt-4">
                        <div class="flex justify-between items-center">
                            <p class="text-lg font-bold text-gray-900">Total Harga</p>
                            <p id="confirm-total-price" class="text-xl font-bold text-blue-700">Rp 0</p>
                        </div>
                    </div>

                    <div class="flex gap-4 mt-6">
                        <button id="back-button" type="button"
                            class="w-1/2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">
                            Kembali
                        </button>
                        <button id="confirm-button" type="button"
                            class="w-1/2 text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <i class="fas fa-check mr-2"></i> Konfirmasi Pesanan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="booking-success-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow border border-gray-200">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 rounded-t">
                <h3 class="text-xl font-bold text-gray-900">
                    Pesanan Berhasil Dibuat!
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="booking-success-modal">
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
                <div class="w-12 h-12 rounded-full bg-green-100 p-2 flex items-center justify-center mx-auto mb-3.5">
                    <i class="fas fa-check text-green-500 text-xl"></i>
                </div>
                <p class="mb-4 text-lg font-semibold text-gray-900">Terima kasih!</p>
                <p class="text-gray-500 mb-6">Pesanan Anda telah berhasil dibuat dan akan segera diproses. Admin kami
                    akan menghubungi Anda melalui WhatsApp dalam waktu 1x24 jam untuk konfirmasi lebih lanjut.</p>
                <button data-modal-hide="booking-success-modal" type="button"
                    class="text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Prevent multiple event listener registration
        if (window.bookingModalInitialized) {
            return;
        }
        window.bookingModalInitialized = true;
        // Get form elements
        const bookingForm = document.getElementById('booking-form');
        const serviceTypeSelect = document.getElementById('service-type');
        const startDateInput = document.getElementById('start-date');
        const endDateInput = document.getElementById('end-date');

        // Get buttons
        const backButton = document.getElementById('back-button');
        const confirmButton = document.getElementById('confirm-button');

        // Initialize date pickers
        if (startDateInput && endDateInput) {
            // Set minimum date to today
            const today = new Date().toISOString().split('T')[0];
            startDateInput.min = today;
            endDateInput.min = today;

            // Update end date min value when start date changes
            startDateInput.addEventListener('change', function() {
                endDateInput.min = startDateInput.value;
                if (endDateInput.value && new Date(endDateInput.value) < new Date(startDateInput
                        .value)) {
                    endDateInput.value = startDateInput.value;
                }
            });
        }

        // Handle form submission
        if (bookingForm) {
            bookingForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Get form data
                const formData = new FormData(bookingForm);
                const serviceTypeSelect = document.getElementById('service-type');
                const selectedServiceId = serviceTypeSelect.value || formData.get('service-id') || getServiceIdFromPage();
                
                const bookingData = {
                    service_id: selectedServiceId,
                    name: formData.get('full-name'),
                    email: formData.get('email'),
                    whatsapp_number: formData.get('whatsapp'),
                    number_of_participants: parseInt(formData.get('participants')),
                    pickup_location: formData.get('pickup-location'),
                    start_date: formData.get('start-date'),
                    end_date: formData.get('end-date'),
                    message: formData.get('message') || ''
                };

                // Validate required fields
                if (!bookingData.service_id || !bookingData.name || !bookingData.email ||
                    !bookingData.whatsapp_number || !bookingData.pickup_location ||
                    !bookingData.start_date || !bookingData.end_date) {
                    alert('Mohon lengkapi semua field yang wajib diisi.');
                    return;
                }

                // Calculate number of days
                const start = new Date(bookingData.start_date);
                const end = new Date(bookingData.end_date);
                const days = Math.max(1, Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1);

                // Get base price from selected service
                const selectedOption = serviceTypeSelect.options[serviceTypeSelect.selectedIndex];
                const basePrice = parseInt(selectedOption?.dataset?.price) || 1000000;
                const serviceName = selectedOption?.textContent || 'Layanan';

                // Calculate total price (base price * days * participants)
                const totalPrice = basePrice * days * parseInt(bookingData.number_of_participants);

                // Update confirmation modal with booking details
                document.getElementById('confirm-full-name').textContent = bookingData.name;
                document.getElementById('confirm-email').textContent = bookingData.email;
                document.getElementById('confirm-whatsapp').textContent = bookingData.whatsapp_number;
                document.getElementById('confirm-participants').textContent = bookingData
                    .number_of_participants;
                document.getElementById('confirm-pickup').textContent = bookingData.pickup_location;
                document.getElementById('confirm-dates').textContent =
                    `${bookingData.start_date} - ${bookingData.end_date} (${days} hari)`;
                document.getElementById('confirm-service').textContent = serviceName;
                document.getElementById('confirm-message').textContent = bookingData.message || '-';
                document.getElementById('confirm-total-price').textContent =
                    `Rp ${totalPrice.toLocaleString('id-ID')}`;

                // Store booking data for later submission
                window.currentBookingData = bookingData;

                // Hide booking modal and show confirmation modal
                hideModal('booking-modal');
                showModal('confirmation-modal');
            });
        }

        // Handle back button click
        if (backButton) {
            backButton.addEventListener('click', function() {
                // Hide confirmation modal and show booking modal
                hideModal('confirmation-modal');
                showModal('booking-modal');
            });
        }

        // Handle confirmation button click
        if (confirmButton) {
            confirmButton.addEventListener('click', function() {
                const bookingData = window.currentBookingData;

                if (!bookingData) {
                    alert('Data booking tidak ditemukan. Silakan coba lagi.');
                    return;
                }

                // Prevent multiple submissions
                if (window.bookingSubmitting) {
                    return;
                }
                window.bookingSubmitting = true;

                // Disable button to prevent double submission
                confirmButton.disabled = true;
                confirmButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';

                // Submit order to API
                fetch('/api/public/orders', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                ?.getAttribute('content') || ''
                        },
                        body: JSON.stringify(bookingData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Hide confirmation modal and show success modal
                            hideModal('confirmation-modal');
                            showModal('booking-success-modal');

                            // Reset form and clear data
                            bookingForm.reset();
                            window.currentBookingData = null;
                        } else {
                            throw new Error(data.message ||
                                'Terjadi kesalahan saat membuat pesanan.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan: ' + error.message);
                    })
                    .finally(() => {
                        // Re-enable button and reset submission flag
                        confirmButton.disabled = false;
                        confirmButton.innerHTML =
                            '<i class="fas fa-check mr-2"></i> Konfirmasi Pesanan';
                        window.bookingSubmitting = false;
                    });
            });
        }

        // Helper functions to show/hide modals
        function showModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        }

        function hideModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = 'auto';
            }
        }

        // Pre-select service type if coming from detail page or if service ID is provided
        function preSelectService() {
            if (!serviceTypeSelect) return;
            
            // Try to get service ID from various sources
            let serviceId = null;
            
            // 1. From button data attribute
            const bookingButton = document.querySelector('[data-modal-target="booking-modal"]');
            if (bookingButton && bookingButton.dataset.serviceId) {
                serviceId = bookingButton.dataset.serviceId;
            }
            
            // 2. From URL if on detail page
            if (!serviceId && window.location.pathname.includes('/detail')) {
                const pathParts = window.location.pathname.split('/');
                const serviceIndex = pathParts.indexOf('services');
                if (serviceIndex !== -1 && pathParts[serviceIndex + 1]) {
                    serviceId = pathParts[serviceIndex + 1];
                }
            }
            
            // 3. Try to match by service name from page title
            if (!serviceId && window.location.pathname.includes('/detail')) {
                const serviceName = document.querySelector('h1.text-5xl')?.textContent.trim();
                if (serviceName) {
                    for (let i = 0; i < serviceTypeSelect.options.length; i++) {
                        if (serviceTypeSelect.options[i].textContent.includes(serviceName)) {
                            serviceTypeSelect.selectedIndex = i;
                            return;
                        }
                    }
                }
            }
            
            // Select by service ID
            if (serviceId) {
                for (let i = 0; i < serviceTypeSelect.options.length; i++) {
                    if (serviceTypeSelect.options[i].value === serviceId) {
                        serviceTypeSelect.selectedIndex = i;
                        break;
                    }
                }
            }
        }
        
        // Call pre-select function
        preSelectService();

        // Handle modal close buttons
        document.querySelectorAll('[data-modal-hide]').forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('data-modal-hide');
                hideModal(modalId);
            });
        });

        // Handle modal backdrop clicks
        document.querySelectorAll('[id$="-modal"]').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    hideModal(this.id);
                }
            });
        });
    });

    // Helper function to get service ID from page
    function getServiceIdFromPage() {
        // Try to get from button data attribute
        const bookingButton = document.querySelector('[data-modal-target="booking-modal"]');
        if (bookingButton && bookingButton.dataset.serviceId) {
            return bookingButton.dataset.serviceId;
        }

        // Try to get from URL if on detail page
        const pathParts = window.location.pathname.split('/');
        if (pathParts.includes('services') && pathParts.includes('detail')) {
            const serviceIndex = pathParts.indexOf('services');
            return pathParts[serviceIndex + 1];
        }

        return null;
    }
</script>
