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
                                <optgroup label="Sewa Mobil">
                                    @if (isset($carRentals) && count($carRentals) > 0)
                                        @foreach ($carRentals as $car)
                                            <option value="{{ $car->id }}" data-type="car"
                                                data-price="{{ $car->price }}">{{ $car->name }} - Rp
                                                {{ number_format($car->price, 0, ',', '.') }}/hari</option>
                                        @endforeach
                                    @else
                                        <option value="innova" data-type="car" data-price="2000000">Innova Reborn - Rp
                                            2.000.000/hari</option>
                                        <option value="avanza" data-type="car" data-price="1500000">Avanza - Rp
                                            1.500.000/hari</option>
                                        <option value="jeep" data-type="car" data-price="1000000">Jeep - Rp
                                            1.000.000/hari</option>
                                    @endif
                                </optgroup>
                                <optgroup label="Paket Tour">
                                    @if (isset($tourPackages) && count($tourPackages) > 0)
                                        @foreach ($tourPackages as $tour)
                                            <option value="{{ $tour->id }}" data-type="tour"
                                                data-price="{{ $tour->price }}">{{ $tour->name }} - Rp
                                                {{ number_format($tour->price, 0, ',', '.') }}/hari</option>
                                        @endforeach
                                    @else
                                        <option value="bali-tour" data-type="tour" data-price="3000000">Bali Tour - Rp
                                            3.000.000/hari</option>
                                        <option value="bromo-tour" data-type="tour" data-price="2500000">Bromo Tour - Rp
                                            2.500.000/hari</option>
                                        <option value="city-tour" data-type="tour" data-price="1800000">City Tour - Rp
                                            1.800.000/hari</option>
                                    @endif
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

                    <p class="text-sm text-gray-500">Mohon diperiksa kembali sebelum melakukan pembayaran. Pastikan
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
                            <i class="fa-brands fa-whatsapp mr-2"></i> Konfirmasi via WhatsApp
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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
                const bookingData = {
                    fullName: formData.get('full-name'),
                    email: formData.get('email'),
                    whatsapp: formData.get('whatsapp'),
                    participants: formData.get('participants'),
                    pickupLocation: formData.get('pickup-location'),
                    startDate: formData.get('start-date'),
                    endDate: formData.get('end-date'),
                    serviceType: formData.get('service-type'),
                    message: formData.get('message')
                };

                // Calculate number of days
                const start = new Date(bookingData.startDate);
                const end = new Date(bookingData.endDate);
                const days = Math.max(1, Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1);

                // Get base price from selected service
                const selectedOption = serviceTypeSelect.options[serviceTypeSelect.selectedIndex];
                const basePrice = parseInt(selectedOption.dataset.price) ||
                    1000000; // Default price if not set

                // Calculate total price (base price * days * participants)
                const totalPrice = basePrice * days * parseInt(bookingData.participants);

                // Update confirmation modal with booking details
                document.getElementById('confirm-full-name').textContent = bookingData.fullName;
                document.getElementById('confirm-email').textContent = bookingData.email;
                document.getElementById('confirm-whatsapp').textContent = bookingData.whatsapp;
                document.getElementById('confirm-participants').textContent = bookingData.participants;
                document.getElementById('confirm-pickup').textContent = bookingData.pickupLocation;
                document.getElementById('confirm-dates').textContent =
                    `${bookingData.startDate} - ${bookingData.endDate} (${days} hari)`;
                document.getElementById('confirm-service').textContent = selectedOption.textContent;
                document.getElementById('confirm-message').textContent = bookingData.message || '-';
                document.getElementById('confirm-total-price').textContent =
                    `Rp ${totalPrice.toLocaleString('id-ID')}`;

                // Hide booking modal and show confirmation modal using data attributes
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

        // Handle WhatsApp confirmation button
        if (confirmButton) {
            confirmButton.addEventListener('click', function() {
                // Get booking details
                const fullName = document.getElementById('confirm-full-name').textContent;
                const email = document.getElementById('confirm-email').textContent;
                const whatsapp = document.getElementById('confirm-whatsapp').textContent;
                const participants = document.getElementById('confirm-participants').textContent;
                const pickup = document.getElementById('confirm-pickup').textContent;
                const dates = document.getElementById('confirm-dates').textContent;
                const service = document.getElementById('confirm-service').textContent;
                const message = document.getElementById('confirm-message').textContent;
                const totalPrice = document.getElementById('confirm-total-price').textContent;

                // Create WhatsApp message
                const whatsappMessage = `*BOOKING MEGA SANTOSA TOUR*%0A%0A` +
                    `*Nama:* ${fullName}%0A` +
                    `*Email:* ${email}%0A` +
                    `*WhatsApp:* ${whatsapp}%0A` +
                    `*Jumlah Peserta:* ${participants}%0A` +
                    `*Lokasi Pickup:* ${pickup}%0A` +
                    `*Tanggal:* ${dates}%0A` +
                    `*Layanan:* ${service}%0A` +
                    `*Pesan:* ${message}%0A` +
                    `*Total Harga:* ${totalPrice}%0A%0A` +
                    `Mohon konfirmasi pemesanan saya. Terima kasih!`;

                // Open WhatsApp with pre-filled message
                // Replace the phone number with your business WhatsApp number
                window.open(`https://wa.me/628123456789?text=${whatsappMessage}`, '_blank');

                // Close the modal after opening WhatsApp
                hideModal('confirmation-modal');
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

        // Pre-select service type if coming from detail page
        if (window.location.pathname.includes('/detail')) {
            // Try to get service info from the page
            const serviceName = document.querySelector('h1.text-5xl')?.textContent.trim();

            if (serviceName && serviceTypeSelect) {
                // Find and select the option that matches the service name
                for (let i = 0; i < serviceTypeSelect.options.length; i++) {
                    if (serviceTypeSelect.options[i].textContent.includes(serviceName)) {
                        serviceTypeSelect.selectedIndex = i;
                        break;
                    }
                }
            }
        }

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
</script>
