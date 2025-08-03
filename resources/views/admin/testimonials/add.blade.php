@extends('layouts.admin_layout')

@section('content')
    <div
        class="px-6 py-8 bg-white block sm:flex items-center justify-between lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard.index') }}"
                                class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Admin
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <a href="{{ route('admin.testimonials.index') }}"
                                    class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Testimoni</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Tambah
                                    Testimoni</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Tambah Testimoni Baru</h1>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="p-6">
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.testimonials.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" required value="{{ old('name') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white @error('name') border-red-500 @enderror"
                                placeholder="Masukkan nama lengkap" />
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Layanan -->
                        <div>
                            <label for="type_of_service"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                                Layanan yang Digunakan <span class="text-red-500">*</span></label>
                            <select name="type_of_service" id="type_of_service" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white @error('type_of_service') border-red-500 @enderror">
                                <option value="" disabled selected>Pilih jenis layanan</option>
                                <option value="Layanan Sewa Mobil" {{ old('type_of_service') == 'Layanan Sewa Mobil' ? 'selected' : '' }}>Layanan Sewa Mobil</option>
                                <option value="Layanan Paket Tour" {{ old('type_of_service') == 'Layanan Paket Tour' ? 'selected' : '' }}>Layanan Paket Tour</option>
                            </select>
                            @error('type_of_service')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Rating Layanan -->
                    <div class="mt-6">
                        <label for="rating"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating
                            Layanan <span class="text-red-500">*</span></label>
                        <div class="flex items-center space-x-1">
                            <div class="flex items-center">
                                <input type="radio" name="rating" id="rating-1" value="1" class="sr-only" required {{ old('rating') == '1' ? 'checked' : '' }}>
                                <label for="rating-1"
                                    class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400 transition-colors duration-200">
                                    <i class="fas fa-star"></i>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="rating" id="rating-2" value="2" class="sr-only" {{ old('rating') == '2' ? 'checked' : '' }}>
                                <label for="rating-2"
                                    class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400 transition-colors duration-200">
                                    <i class="fas fa-star"></i>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="rating" id="rating-3" value="3" class="sr-only" {{ old('rating') == '3' ? 'checked' : '' }}>
                                <label for="rating-3"
                                    class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400 transition-colors duration-200">
                                    <i class="fas fa-star"></i>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="rating" id="rating-4" value="4" class="sr-only" {{ old('rating') == '4' ? 'checked' : '' }}>
                                <label for="rating-4"
                                    class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400 transition-colors duration-200">
                                    <i class="fas fa-star"></i>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="rating" id="rating-5" value="5" class="sr-only" {{ old('rating') == '5' ? 'checked' : '' }}>
                                <label for="rating-5"
                                    class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400 transition-colors duration-200">
                                    <i class="fas fa-star"></i>
                                </label>
                            </div>
                            <span id="rating-text" class="ml-2 text-sm text-gray-500 dark:text-gray-400">Pilih
                                rating</span>
                        </div>
                        @error('rating')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pesan Testimoni -->
                    <div class="mt-6">
                        <label for="message"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pesan
                            Testimoni <span class="text-red-500">*</span></label>
                        <textarea name="message" id="message" rows="6" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white @error('message') border-red-500 @enderror"
                            placeholder="Ceritakan pengalaman Anda menggunakan layanan kami...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mt-6">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white @error('status') border-red-500 @enderror">
                            <option value="" disabled selected>Pilih status</option>
                            <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-2 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('admin.testimonials.index') }}"
                            class="px-6 py-2.5 text-sm font-medium text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300">
                            Simpan Testimoni
                            <svg class="w-5 h-5 inline ml-1.5" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v6.41A7.5 7.5 0 1 0 10.5 22H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                                    clip-rule="evenodd" />
                                <path fill-rule="evenodd"
                                    d="M9 16a6 6 0 1 1 12 0 6 6 0 0 1-12 0Zm6-3a1 1 0 0 1 1 1v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 1 1 0-2h1v-1a1 1 0 0 1 1-1Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <!-- Font Awesome for star icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ratingInputs = document.querySelectorAll('input[name="rating"]');
            const ratingLabels = document.querySelectorAll('label[for^="rating-"]');
            const ratingText = document.getElementById('rating-text');

            let currentRating = {{ old('rating', 0) }};
            const ratingTexts = {
                1: 'Sangat Buruk',
                2: 'Buruk',
                3: 'Cukup',
                4: 'Baik',
                5: 'Sangat Baik'
            };

            // Initialize rating display
            updateRatingDisplay(currentRating);

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
                        star.classList.remove('text-gray-300', 'dark:text-gray-600');
                        star.classList.add('text-yellow-400');
                    } else {
                        star.classList.remove('text-yellow-400');
                        star.classList.add('text-gray-300', 'dark:text-gray-600');
                    }
                });

                if (rating > 0) {
                    ratingText.textContent = ratingTexts[rating];
                } else {
                    ratingText.textContent = 'Pilih rating';
                }
            }
        });
    </script>
@endpush
