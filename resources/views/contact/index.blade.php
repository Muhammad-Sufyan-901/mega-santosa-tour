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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <!-- WhatsApp -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.465 3.516" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">WhatsApp</h3>
                <p class="text-gray-600 mb-4">{{ $contactData['whatsapp'] }}</p>
                <button type="button"
                    class="w-full text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center">
                    Hubungi
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </button>
            </div>

            <!-- Instagram -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="flex justify-center mb-4">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-purple-600 to-pink-500 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Instagram</h3>
                <p class="text-gray-600 mb-4">{{ $contactData['instagram'] }}</p>
                <button type="button"
                    class="w-full text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center">
                    Hubungi
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </button>
            </div>

            <!-- Email -->
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-gray-900 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Email</h3>
                <p class="text-gray-600 mb-4">{{ $contactData['email'] }}</p>
                <button type="button"
                    class="w-full text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center">
                    Hubungi
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </button>
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
        <iframe width="1024" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
            id="gmap_canvas" class="w-full" src="{{ $contactData['map_embed'] }}"></iframe>
        <a href='https://www.acadoo.de/'>acadoo</a>
        <script type='text/javascript'
            src='https://embedmaps.com/google-maps-authorization/script.js?id=7850590ffac6543edf0a6aa6cd6c97813ed6bd00'>
        </script>

        <!-- Contact Form -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>
            <form class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                        <input type="text" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="nama@contoh.com" required>
                    </div>
                </div>
                <div>
                    <label for="subject" class="block mb-2 text-sm font-medium text-gray-900">Subjek</label>
                    <input type="text" id="subject"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Subjek pesan" required>
                </div>
                <div>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Pesan</label>
                    <textarea id="message" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tulis pesan Anda di sini..." required></textarea>
                </div>
                <button type="submit"
                    class="w-full md:w-auto text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Kirim Pesan
                </button>
            </form>
        </div>

        <script>
            // Add any additional JavaScript functionality here
            document.addEventListener('DOMContentLoaded', function() {
                // Handle contact buttons
                const contactButtons = document.querySelectorAll('button:contains("Hubungi")');
                contactButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const card = this.closest('.bg-white');
                        const title = card.querySelector('h3').textContent;

                        if (title === 'WhatsApp') {
                            const phoneNumber =
                                '{{ str_replace(['+', '-', ' '], '', $contactData['whatsapp']) }}';
                            window.open('https://wa.me/' + phoneNumber, '_blank');
                        } else if (title === 'Instagram') {
                            const instagram = '{{ $contactData['instagram'] }}';
                            const instagramHandle = instagram.startsWith('@') ? instagram.substring(1) :
                                instagram;
                            window.open('https://instagram.com/' + instagramHandle, '_blank');
                        } else if (title === 'Email') {
                            window.location.href = 'mailto:{{ $contactData['email'] }}';
                        }
                    });
                });

                // Handle form submission
                document.querySelector('form').addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert('Pesan berhasil dikirim! Kami akan menghubungi Anda segera.');
                    this.reset();
                });
            });
        </script>
    </section>
@endsection
