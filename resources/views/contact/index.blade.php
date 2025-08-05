@extends('layouts.main_layout')

@section('content')
    <section class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="max-w-screen-md mx-auto text-center mb-8 lg:mb-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">
                Kontak Kami
            </h2>
            <p class="mb-5 font-light text-gray-500 sm:text-xl">
                "Hubungi kami melalui beberapa metode di bawah ini."
            </p>
        </div>

        <!-- Contact Methods -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <!-- WhatsApp -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center">
                        <i class="fab fa-whatsapp text-white text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">WhatsApp</h3>
                <p class="text-gray-600 mb-4">{{ $contactData['whatsapp'] }}</p>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactData['whatsapp']) }}" target="_blank"
                    class="w-full text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center">
                    Hubungi
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>

            <!-- Instagram -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="flex justify-center mb-4">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-purple-600 to-pink-500 rounded-full flex items-center justify-center">
                        <i class="fab fa-instagram text-white text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Instagram</h3>
                <p class="text-gray-600 mb-4">{{ $contactData['instagram'] }}</p>
                <a href="https://instagram.com/{{ str_replace('@', '', $contactData['instagram']) }}" target="_blank"
                    class="w-full text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center">
                    Hubungi
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>

            <!-- TikTok -->
            @if (isset($contactData['tiktok']) && !empty($contactData['tiktok']))
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="flex justify-center mb-4">
                        <div class="w-16 h-16 bg-black rounded-full flex items-center justify-center">
                            <i class="fab fa-tiktok text-white text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">TikTok</h3>
                    <p class="text-gray-600 mb-4">{{ $contactData['tiktok'] }}</p>
                    <a href="{{ 'https://www.tiktok.com/@' . $contactData['tiktok'] }}" target="_blank"
                        class="w-full text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center">
                        Hubungi
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            @endif

            <!-- Email -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-gray-900 rounded-full flex items-center justify-center">
                        <i class="fas fa-envelope text-white text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Email</h3>
                <p class="text-gray-600 mb-4">{{ $contactData['email'] }}</p>
                <a href="mailto:{{ $contactData['email'] }}"
                    class="w-full text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center">
                    Hubungi
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Location Section -->
        {{-- <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Lokasi Kami</h2>
            <p class="text-gray-600 mb-6">Jl. Alamat Kantor Pusat</p>

            <!-- Map Container -->
            <div class="relative h-96 bg-gray-200 rounded-lg overflow-hidden">
                <!-- Placeholder for map - you can integrate Google Maps or other mapping service -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="text-gray-500">Peta akan dimuat di sini</p>
                        <p class="text-sm text-gray-400 mt-2">Integrasikan dengan Google Maps atau layanan peta lainnya</p>
                    </div>
                </div>

                <!-- Red marker indicator -->
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <div class="w-6 h-6 bg-red-500 rounded-full border-2 border-white shadow-lg"></div>
                </div>
            </div>
        </div> --}}
        <!-- Location Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Lokasi Kami</h2>
            <p class="text-gray-600 mb-6">{{ $contactData['address'] ?? 'Jl. Alamat Kantor Pusat' }}</p>

            <!-- Map Container -->
            <iframe width="1024" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                id="gmap_canvas" class="w-full rounded-lg" src="{{ $contactData['map_embed'] }}"></iframe>
        </div>

        <!-- Contact Form -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>

            <!-- Success Message -->
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
            @endif

            <!-- Error Message -->
            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('name') border-red-500 @enderror"
                            placeholder="Masukkan nama lengkap" required>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('email') border-red-500 @enderror"
                            placeholder="nama@contoh.com" required>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="subject" class="block mb-2 text-sm font-medium text-gray-900">Subjek</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('subject') border-red-500 @enderror"
                        placeholder="Subjek pesan" required>
                    @error('subject')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Pesan</label>
                    <textarea id="message" name="message" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 @error('message') border-red-500 @enderror"
                        placeholder="Tulis pesan Anda di sini..." required>{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full md:w-auto text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <i class="fas fa-paper-plane mr-2"></i> Kirim Pesan
                </button>
            </form>
        </div>


    </section>
@endsection
