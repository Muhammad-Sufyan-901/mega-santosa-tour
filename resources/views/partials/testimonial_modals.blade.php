<!-- Add Testimonial Modal -->
<div id="testimonial-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-3xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow border border-gray-200">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 rounded-t">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">
                        Tambah Testimoni
                    </h3>
                    <p class="text-sm text-gray-500">Berikan testimoni Anda untuk membantu calon pelanggan lain.</p>
                </div>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="testimonial-modal">
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
                <form id="testimonial-form" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="testimonial-name" class="block mb-2 text-sm font-medium text-gray-900">Nama
                                Lengkap</label>
                            <input type="text" name="name" id="testimonial-name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Masukkan nama lengkap" required />
                        </div>
                        <div>
                            <label for="testimonial-service" class="block mb-2 text-sm font-medium text-gray-900">Jenis
                                Layanan yang Digunakan</label>
                            <select name="service" id="testimonial-service"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required>
                                <option value="" disabled selected>Pilih jenis layanan</option>
                                <option value="Layanan Sewa Mobil">Layanan Sewa Mobil</option>
                                <option value="Layanan Paket Tour">Layanan Paket Tour</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="testimonial-rating" class="block mb-2 text-sm font-medium text-gray-900">Rating
                            Layanan</label>
                        <div class="flex items-center space-x-1">
                            <div class="flex items-center">
                                <input type="radio" name="rating" id="rating-1" value="1" class="sr-only"
                                    required>
                                <label for="rating-1"
                                    class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400 transition-colors duration-200">
                                    <i class="fas fa-star"></i>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="rating" id="rating-2" value="2" class="sr-only">
                                <label for="rating-2"
                                    class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400 transition-colors duration-200">
                                    <i class="fas fa-star"></i>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="rating" id="rating-3" value="3" class="sr-only">
                                <label for="rating-3"
                                    class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400 transition-colors duration-200">
                                    <i class="fas fa-star"></i>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="rating" id="rating-4" value="4" class="sr-only">
                                <label for="rating-4"
                                    class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400 transition-colors duration-200">
                                    <i class="fas fa-star"></i>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="rating" id="rating-5" value="5" class="sr-only">
                                <label for="rating-5"
                                    class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400 transition-colors duration-200">
                                    <i class="fas fa-star"></i>
                                </label>
                            </div>
                            <span id="rating-text" class="ml-2 text-sm text-gray-500">Pilih rating</span>
                        </div>
                    </div>

                    <div>
                        <label for="testimonial-message" class="block mb-2 text-sm font-medium text-gray-900">Pesan
                            Testimoni</label>
                        <textarea name="message" id="testimonial-message" rows="4"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Ceritakan pengalaman Anda menggunakan layanan kami..." required></textarea>
                    </div>

                    <div class="flex gap-4 mt-6">
                        <button type="button" data-modal-hide="testimonial-modal"
                            class="w-1/2 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">
                            Batal
                        </button>
                        <button type="submit"
                            class="w-1/2 text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Testimoni
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="testimonial-success-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow border border-gray-200">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 rounded-t">
                <h3 class="text-xl font-bold text-gray-900">
                    Testimoni Berhasil Dikirim
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="testimonial-success-modal">
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
                <p class="text-gray-500 mb-6">Testimoni Anda telah berhasil dikirim dan akan segera ditampilkan setelah
                    diverifikasi.</p>
                <button data-modal-hide="testimonial-success-modal" type="button"
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
        if (window.testimonialModalInitialized) {
            return;
        }
        window.testimonialModalInitialized = true;
        // Get form elements
        const testimonialForm = document.getElementById('testimonial-form');
        const ratingInputs = document.querySelectorAll('input[name="rating"]');
        const ratingLabels = document.querySelectorAll('label[for^="rating-"]');
        const ratingText = document.getElementById('rating-text');

        // Rating functionality
        let currentRating = 0;
        const ratingTexts = {
            1: 'Sangat Buruk',
            2: 'Buruk',
            3: 'Cukup',
            4: 'Baik',
            5: 'Sangat Baik'
        };

        // Handle rating selection
        ratingInputs.forEach((input, index) => {
            input.addEventListener('change', function() {
                currentRating = parseInt(this.value);
                updateRatingDisplay();
            });
        });

        // Handle rating hover effects
        ratingLabels.forEach((label, index) => {
            label.addEventListener('mouseenter', function() {
                const hoverRating = index + 1;
                updateRatingDisplay(hoverRating);
            });

            label.addEventListener('mouseleave', function() {
                updateRatingDisplay(currentRating);
            });
        });

        function updateRatingDisplay(rating = currentRating) {
            ratingLabels.forEach((label, index) => {
                const star = label.querySelector('i');
                if (index < rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });

            if (rating > 0) {
                ratingText.textContent = ratingTexts[rating];
            } else {
                ratingText.textContent = 'Pilih rating';
            }
        }

        // Handle form submission
        if (testimonialForm) {
            testimonialForm.addEventListener('submit', function(e) {
                console.log('Form submit event triggered');
                e.preventDefault();

                // Get form data
                const formData = new FormData(testimonialForm);
                const testimonialData = {
                    name: formData.get('name'),
                    service: formData.get('service'),
                    rating: formData.get('rating'),
                    message: formData.get('message')
                };

                console.log('Form data collected:', testimonialData);

                // Validate all required fields
                if (!testimonialData.name) {
                    alert('Silakan masukkan nama lengkap');
                    return;
                }
                
                if (!testimonialData.service) {
                    alert('Silakan pilih jenis layanan');
                    return;
                }

                if (!testimonialData.rating) {
                    alert('Silakan pilih rating terlebih dahulu');
                    return;
                }

                if (!testimonialData.message) {
                    alert('Silakan masukkan pesan testimoni');
                    return;
                }

                console.log('All validations passed, preparing to submit');

                // Prevent multiple submissions
                if (window.testimonialSubmitting) {
                    return;
                }
                window.testimonialSubmitting = true;

                // Debug log before submission
                console.log('Submitting testimonial data:', testimonialData);

                // Submit testimonial to API
                fetch('/api/public/testimonials', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                ?.getAttribute('content') || ''
                        },
                        body: JSON.stringify(testimonialData)
                    })
                    .then(response => {
                        console.log('Response status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data);
                        if (data.success) {
                            // Hide testimonial modal and show success modal
                            hideModal('testimonial-modal');
                            showModal('testimonial-success-modal');

                            // Reset form
                            testimonialForm.reset();
                            currentRating = 0;
                            updateRatingDisplay();
                        } else {
                            throw new Error(data.message || 'Terjadi kesalahan saat mengirim testimoni.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan: ' + error.message);
                    })
                    .finally(() => {
                        // Reset submission flag
                        window.testimonialSubmitting = false;
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
