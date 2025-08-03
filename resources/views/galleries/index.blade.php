@extends('layouts.main_layout')

@section('content')
    {{-- Gallery Section - Updated Layout --}}
    <section class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="max-w-screen-md mx-auto text-center mb-8 lg:mb-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">
                {{ $content['gallery_section_title'] ?? 'Galeri Kami' }}
            </h2>
            <p class="mb-5 font-light text-gray-500 sm:text-xl">
                "{{ $content['gallery_section_description'] ?? 'Lihat beberapa gambar dari mobil-mobil kami yang siap disewa.' }}"
            </p>
        </div>

        @if ($galleryImages->count() > 0)
            {{-- Desktop: 4x2 Layout, Mobile: 2x4 Layout --}}
            {{-- <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                @foreach ($galleryImages->take(8) as $index => $image)
                    <div
                        class="relative group overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                        <div class="aspect-square">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300 cursor-pointer"
                                src="{{ asset('assets/images/galleries/thumbnails/' . $image->thumbnail) }}"
                                alt="{{ $image->title ?? 'Gallery Image' }}"
                                onclick="openImageModal('{{ asset('assets/images/galleries/' . $image->image) }}', '{{ $image->title ?? 'Gallery Image' }}')">
                        </div>

                        Overlay with title
                        <div
                            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-end">
                            <div
                                class="p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                <h3 class="text-sm font-semibold">{{ $image->title ?? 'Gallery Image' }}</h3>
                                @if ($image->description)
                                    <p class="text-xs opacity-90 mt-1">{{ Str::limit($image->description, 50) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}

            {{-- Alternative: 3x2 Layout for larger images --}}
            {{-- Uncomment this section if you prefer 3x2 layout --}}

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                @foreach ($galleryImages->take(6) as $index => $image)
                    <div
                        class="relative group overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                        <div class="aspect-[4/3]">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300 cursor-pointer"
                                src="{{ asset('assets/images/galleries/thumbnails/' . $image->thumbnail) }}"
                                alt="{{ $image->title ?? 'Gallery Image' }}"
                                onclick="openImageModal('{{ asset('assets/images/galleries/' . $image->image) }}', '{{ $image->title ?? 'Gallery Image' }}')">
                        </div>

                        <div
                            class="absolute inset-0 bg-black/15 bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-end">
                            <div
                                class="p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                <h3 class="text-sm font-semibold">{{ $image->title ?? 'Gallery Image' }}</h3>
                                @if ($image->description)
                                    <p class="text-xs opacity-90 mt-1">{{ Str::limit($image->description, 50) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            {{-- Show More Button if there are more images --}}
            @if ($galleryImages->count() > 8)
                <div class="text-center">
                    <a href="{{ route('galleries.index') }}"
                        class="inline-flex items-center px-6 py-3 text-base font-medium text-center text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg">
                        <i class="fas fa-images mr-2"></i>
                        Lihat Semua Galeri ({{ $galleryImages->count() }} Foto)
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <div class="w-24 h-24 mx-auto mb-4 text-gray-300">
                    <i class="fas fa-images text-6xl"></i>
                </div>
                <p class="text-gray-500 text-lg">Belum ada gambar galeri tersedia.</p>
                <p class="text-gray-400 text-sm mt-2">Gambar galeri akan ditampilkan di sini setelah ditambahkan oleh
                    admin.</p>
            </div>
        @endif
    </section>

    <section class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="max-w-screen-md mx-auto text-center mb-8 lg:mb-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">
                {{ $content['testimonial_section_title'] ?? 'Apa Kata Klien Kami' }}
            </h2>
            <p class="mb-5 font-light text-gray-500 sm:text-xl">
                "{{ $content['testimonial_description'] ?? 'Kami selalu berusaha memberikan layanan terbaik untuk kepuasan klien kami. Berikut adalah beberapa testimoni dari klien yang telah menggunakan layanan kami.' }}"
            </p>
        </div>

        @if ($testimonialSlides->count() > 0)
            <!-- Carousel wrapper -->
            <div id="testimonial-carousel" class="relative w-full mb-10" data-carousel="slide">
                <!-- Carousel inner -->
                <div class="relative h-[420px] overflow-hidden rounded-lg p-8">
                    @foreach ($testimonialSlides as $index => $slide)
                        <!-- Item {{ $index + 1 }} -->
                        <div class="{{ $index === 0 ? '' : 'hidden' }} duration-[900ms] ease-in-out"
                            data-carousel-item="{{ $index === 0 ? 'active' : '' }}">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 h-full items-center">
                                @foreach ($slide as $testimonial)
                                    <div class="max-w-sm bg-white border border-gray-200 rounded-4xl shadow-sm">
                                        <div class="p-5 text-center">
                                            <div class="flex items-center justify-center">
                                                <div
                                                    class="bg-gray-200 rounded-full w-20 h-20 flex items-center justify-center mb-6">
                                                    <svg class="w-12 h-12 text-gray-800 dark:text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M6 6a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a3 3 0 0 1-3 3H5a1 1 0 1 0 0 2h1a5 5 0 0 0 5-5V8a2 2 0 0 0-2-2H6Zm9 0a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a3 3 0 0 1-3 3h-1a1 1 0 1 0 0 2h1a5 5 0 0 0 5-5V8a2 2 0 0 0-2-2h-3Z"
                                                            clip-rule="evenodd" />
                                                    </svg>

                                                </div>
                                            </div>
                                            <div class="inline-flex items-center text-yellow-400 mb-4 gap-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="fa-solid fa-star text-xl {{ $i <= ($testimonial->rating ?? 5) ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                                @endfor
                                            </div>
                                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                                {{ $testimonial->name }}
                                            </h5>
                                            <p class="mb-3 font-medium text-gray-700">
                                                {{ $testimonial->service_type ?? 'Pengguna Layanan' }}
                                            </p>
                                            <p class="mb-3 font-normal text-sm text-gray-700 italic">
                                                "{{ Str::limit($testimonial->message, 150) }}"
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($testimonialSlides->count() > 1)
                    <!-- Slider indicators -->
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                        @foreach ($testimonialSlides as $index => $slide)
                            <button type="button"
                                class="w-3 h-3 rounded-full {{ $index === 0 ? 'bg-[#1B5DB9]' : 'bg-blue-300' }}"
                                aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $index + 1 }}"
                                data-carousel-slide-to="{{ $index }}"></button>
                        @endforeach
                    </div>

                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#1B5DB9] group-hover:bg-[#1B5DB9] group-focus:ring-4 group-focus:ring-[#1B5DB9] group-focus:outline-none">
                            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#1B5DB9] group-hover:bg-[#1B5DB9] group-focus:ring-4 group-focus:ring-[#1B5DB9] group-focus:outline-none">
                            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                @endif
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500">Belum ada testimoni tersedia.</p>
            </div>
        @endif

        <div class="flex justify-center">
            <button data-modal-target="testimonial-modal" data-modal-toggle="testimonial-modal"
                class="text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center">
                <i class="fas fa-star mr-2"></i> Beri Testimoni
            </button>
        </div>
    </section>
@endsection
