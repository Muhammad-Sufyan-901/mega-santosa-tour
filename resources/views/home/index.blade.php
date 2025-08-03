@extends('layouts.main_layout')

@section('content')
    {{-- Hero Section --}}
    <section class="bg-cover bg-center bg-no-repeat bg-gray-700 bg-blend-multiply"
        style="background-image: url('{{ asset('assets/images/jumbotron/' . $heroData['background_image']) }}')">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-64">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                {{ $heroData['title'] }}
            </h1>
            <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">
                {{ $heroData['subtitle'] }}
            </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <a href="{{ route('services.index') }}"
                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg">
                    {{ $heroData['cta_primary_text'] }}
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>

                <a href="#tentang-kami"
                    class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                    {{ $heroData['cta_secondary_text'] }}
                </a>
            </div>
        </div>
    </section>

    {{-- Services Section --}}
    <section class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="max-w-screen-md mx-auto text-center mb-8 lg:mb-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">
                {{ $content['service_section_title'] ?? 'Layanan Kami' }}
            </h2>
            <p class="mb-5 font-light text-gray-500 sm:text-xl">
                "{{ $content['service_section_description'] ?? 'Kami menyediakan layanan sewa mobil dan paket tour terbaik untuk perjalanan nyaman dan seru bersama kami!' }}"
            </p>
        </div>

        {{-- Sewa Mobil Section --}}
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-3xl tracking-tight font-extrabold text-gray-900">
                Sewa Mobil
            </h3>

            <a href="{{ route('services.index') }}#sewa-mobil"
                class="inline-flex items-center text-lg font-medium text-[#1B5DB9] hover:underline">
                Semua Sewa Mobil
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
            @if ($sewaMobilServices->count() > 0)
                @foreach ($sewaMobilServices->take(6) as $service)
                    <div class="max-w-sm bg-white border border-gray-200 rounded-4xl shadow-sm">
                        <a href="{{ route('services.detail', $service->id) }}">
                            @if ($service->thumbnail)
                                <img class="rounded-t-4xl w-full h-64 object-cover"
                                    src="{{ asset('assets/images/services/' . $service->thumbnail) }}"
                                    alt="{{ $service->title }}" />
                            @elseif($service->images->count() > 0)
                                <img class="rounded-t-4xl w-full h-64 object-cover"
                                    src="{{ asset('assets/images/services/' . $service->images->first()->image) }}"
                                    alt="{{ $service->title }}" />
                            @else
                                <div class="rounded-t-4xl w-full h-64 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                        </a>
                        <div class="p-5 text-center">
                            <a href="{{ route('services.detail', $service->id) }}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                    {{ $service->title }}
                                </h5>
                            </a>
                            <p class="mb-3 font-medium text-gray-700">
                                Mulai Dari <span class="font-semibold">IDR
                                    {{ number_format($service->price, 0, ',', '.') }}</span>
                            </p>
                            <p class="mb-3 font-normal text-sm text-gray-700 italic">
                                "{{ Str::limit($service->prolog ?? $service->description, 120) }}"
                            </p>
                            <div class="flex gap-2">
                                <a href="{{ route('services.detail', $service->id) }}"
                                    class="flex-1 inline-flex justify-center items-center px-3 py-4 text-sm font-medium text-center text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full">
                                    Lihat Detail
                                </a>
                                {{-- <button
                                    onclick="openBookingModal({{ $service->id }}, '{{ $service->title }}', {{ $service->price }})"
                                    class="px-4 py-4 text-sm font-medium text-center cursor-pointer text-[#1B5DB9] bg-white border border-[#1B5DB9] hover:bg-[#1B5DB9] hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full">
                                    <i class="fas fa-calendar-plus"></i>
                                </button> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500">Belum ada layanan sewa mobil tersedia.</p>
                </div>
            @endif
        </div>

        {{-- Paket Tour Section --}}
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-3xl tracking-tight font-extrabold text-gray-900">
                Paket Tour
            </h3>

            <a href="{{ route('services.index') }}#paket-tour"
                class="inline-flex items-center text-lg font-medium text-[#1B5DB9] hover:underline">
                Semua Paket Tour
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if ($paketTourServices->count() > 0)
                @foreach ($paketTourServices->take(6) as $service)
                    <div class="max-w-sm bg-white border border-gray-200 rounded-4xl shadow-sm">
                        <a href="{{ route('services.detail', $service->id) }}">
                            @if ($service->thumbnail)
                                <img class="rounded-t-4xl w-full h-64 object-cover"
                                    src="{{ asset('assets/images/services/' . $service->thumbnail) }}"
                                    alt="{{ $service->title }}" />
                            @elseif($service->images->count() > 0)
                                <img class="rounded-t-4xl w-full h-64 object-cover"
                                    src="{{ asset('assets/images/services/' . $service->images->first()->image) }}"
                                    alt="{{ $service->title }}" />
                            @else
                                <div class="rounded-t-4xl w-full h-64 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                        </a>
                        <div class="p-5 text-center">
                            <a href="{{ route('services.detail', $service->id) }}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                    {{ $service->title }}
                                </h5>
                            </a>
                            <p class="mb-3 font-medium text-gray-700">
                                Mulai Dari <span class="font-semibold">IDR
                                    {{ number_format($service->price, 0, ',', '.') }}</span>
                            </p>
                            <p class="mb-3 font-normal text-sm text-gray-700 italic">
                                "{{ Str::limit($service->prolog ?? $service->description, 120) }}"
                            </p>
                            <div class="flex gap-2">
                                <a href="{{ route('services.detail', $service->id) }}"
                                    class="flex-1 inline-flex justify-center items-center px-3 py-4 text-sm font-medium text-center text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full">
                                    Lihat Detail
                                </a>
                                {{-- <button
                                    onclick="openBookingModal({{ $service->id }}, '{{ $service->title }}', {{ $service->price }})"
                                    class="px-4 py-4 text-sm font-medium text-center text-[#1B5DB9] bg-white border border-[#1B5DB9] hover:bg-[#1B5DB9] cursor-pointer hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full">
                                    <i class="fas fa-calendar-plus"></i>
                                </button> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500">Belum ada paket tour tersedia.</p>
                </div>
            @endif
        </div>

        <div class="flex justify-center mt-10">
            <a href="{{ route('services.index') }}"
                class="inline-flex items-center px-6 py-3 text-base font-medium text-center text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg">
                Lihat Semua Layanan Kami
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
    </section>

    {{-- About Section --}}
    <section id="tentang-kami" class="bg-gray-100 py-12 lg:py-24 px-12 lg:px-0">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-[45%_50%] gap-20 lg:gap-[5%]">
            <div class="aspect-square relative">
                <div
                    class="absolute -bottom-6 -left-6 w-full h-full bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] rounded-xl z-0">
                </div>

                <div class="rounded-xl relative h-full w-full overflow-hidden z-10 shadow-xl">
                    <img src="{{ asset('assets/images/about/' . $aboutData['image']) }}" alt="Tentang Kami"
                        class="w-full h-full object-cover hover:scale-110 transition-all duration-300 ease-in-out" />
                </div>
            </div>
            <div class="w-full h-full">
                <h2 class="text-2xl md:text-4xl lg:text-6xl font-bold mb-8">{{ $aboutData['title'] }}</h2>
                <p class="text-base text-[#706f6c] mb-5">
                    {!! $aboutData['description'] !!}
                </p>
                {{-- <p class="text-base text-[#706f6c] mb-5">
                    {{ $aboutData['description_2'] }}
                </p> --}}
                <a href="{{ route('services.index') }}"
                    class="inline-flex items-center px-6 py-3 mt-7 text-base font-medium text-center text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg">
                    {{ $aboutData['cta_text'] }}
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
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
                                                    <svg class="w-12 h-12 text-gray-800 dark:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" fill="currentColor"
                                                        viewBox="0 0 24 24">
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
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
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
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
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
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
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

    {{-- Contact Section --}}
    <section class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="max-w-screen-md mx-auto text-center mb-8 lg:mb-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">
                {{ $content['contact_section_title'] ?? 'Kontak Kami' }}
            </h2>
            <p class="mb-5 font-light text-gray-500 sm:text-xl">
                "{{ $content['contact_section_description'] ?? 'Hubungi kami melalui beberapa metode di bawah ini.' }}"
            </p>
        </div>

        <!-- Contact Methods -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
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
            <form id="contact-form" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="contact-name" class="block mb-2 text-sm font-medium text-gray-900">Nama
                            Lengkap</label>
                        <input type="text" id="contact-name" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div>
                        <label for="contact-email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" id="contact-email" name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="nama@contoh.com" required>
                    </div>
                </div>
                <div>
                    <label for="contact-subject" class="block mb-2 text-sm font-medium text-gray-900">Subjek</label>
                    <input type="text" id="contact-subject" name="subject"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Subjek pesan" required>
                </div>
                <div>
                    <label for="contact-message" class="block mb-2 text-sm font-medium text-gray-900">Pesan</label>
                    <textarea id="contact-message" name="message" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tulis pesan Anda di sini..." required></textarea>
                </div>
                <button type="submit"
                    class="w-full md:w-auto text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <i class="fas fa-paper-plane mr-2"></i> Kirim Pesan
                </button>
            </form>
        </div>
    </section>

    {{-- Image Modal for Gallery --}}
    <div id="image-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-4xl max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 id="image-modal-title" class="text-xl font-semibold text-gray-900">
                        Gallery Image
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="image-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5">
                    <img id="image-modal-img" src="/placeholder.svg" alt="" class="w-full h-auto rounded-lg">
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        // Booking Modal Functions
        function openBookingModal(serviceId, serviceName, servicePrice) {
            // Set service data in booking modal
            const serviceSelect = document.getElementById('service-type');
            if (serviceSelect) {
                // Add option if not exists
                let optionExists = false;
                for (let option of serviceSelect.options) {
                    if (option.value == serviceId) {
                        option.selected = true;
                        optionExists = true;
                        break;
                    }
                }

                if (!optionExists) {
                    const newOption = new Option(serviceName + ' - Rp ' + servicePrice.toLocaleString('id-ID'), serviceId);
                    newOption.dataset.price = servicePrice;
                    serviceSelect.add(newOption);
                    newOption.selected = true;
                }
            }

            // Show booking modal
            const modal = document.getElementById('booking-modal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        }

        // Image Modal Functions
        function openImageModal(imageSrc, imageTitle) {
            const modal = document.getElementById('image-modal');
            const modalImg = document.getElementById('image-modal-img');
            const modalTitle = document.getElementById('image-modal-title');

            if (modal && modalImg && modalTitle) {
                modalImg.src = imageSrc;
                modalImg.alt = imageTitle;
                modalTitle.textContent = imageTitle;

                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        }

        // Contact Form Submission
        document.getElementById('contact-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;

            // Show loading state
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';
            submitButton.disabled = true;

            fetch('/api/landing/contact', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Pesan berhasil dikirim! Kami akan menghubungi Anda segera.');
                        this.reset();
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim pesan.');
                })
                .finally(() => {
                    // Reset button state
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                });
        });

        // Enhanced Booking Form Submission
        document.getElementById('booking-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const serviceSelect = document.getElementById('service-type');
            const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];

            // Add service_id to form data
            formData.append('service_id', selectedOption.value);

            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;

            // Show loading state
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
            submitButton.disabled = true;

            fetch('/api/public/orders', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Hide booking modal
                        document.getElementById('booking-modal').classList.add('hidden');
                        document.getElementById('booking-modal').classList.remove('flex');
                        document.body.style.overflow = 'auto';

                        alert('Pesanan berhasil dibuat! Admin akan segera menghubungi Anda.');
                        this.reset();
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat membuat pesanan.');
                })
                .finally(() => {
                    // Reset button state
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                });
        });

        // Enhanced Testimonial Form Submission
        document.getElementById('testimonial-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;

            // Show loading state
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';
            submitButton.disabled = true;

            fetch('/api/public/testimonials', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Hide testimonial modal and show success modal
                        document.getElementById('testimonial-modal').classList.add('hidden');
                        document.getElementById('testimonial-modal').classList.remove('flex');
                        document.getElementById('testimonial-success-modal').classList.remove('hidden');
                        document.getElementById('testimonial-success-modal').classList.add('flex');

                        this.reset();
                        // Reset rating display
                        document.querySelectorAll('label[for^="rating-"] i').forEach(star => {
                            star.classList.remove('text-yellow-400');
                            star.classList.add('text-gray-300');
                        });
                        document.getElementById('rating-text').textContent = 'Pilih rating';
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim testimoni.');
                })
                .finally(() => {
                    // Reset button state
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                });
        });
    </script>

    <!-- Booking Modal -->
    <div id="booking-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="fixed inset-0 bg-black bg-opacity-25"></div>
        <div class="relative p-4 w-full max-w-5xl max-h-full z-10">
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
                        onclick="closeBookingModal()">
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
                                <input type="number" name="participants" id="participants" min="1"
                                    value="1"
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
                                        @if ($sewaMobilServices->count() > 0)
                                            @foreach ($sewaMobilServices as $car)
                                                <option value="{{ $car->id }}" data-type="car"
                                                    data-price="{{ $car->price }}">{{ $car->title }} - Rp
                                                    {{ number_format($car->price, 0, ',', '.') }}/hari</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                    <optgroup label="Paket Tour">
                                        @if ($paketTourServices->count() > 0)
                                            @foreach ($paketTourServices as $tour)
                                                <option value="{{ $tour->id }}" data-type="tour"
                                                    data-price="{{ $tour->price }}">{{ $tour->title }} - Rp
                                                    {{ number_format($tour->price, 0, ',', '.') }}/hari</option>
                                            @endforeach
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
        <div class="fixed inset-0 bg-black bg-opacity-25"></div>
        <div class="relative p-4 w-full max-w-5xl max-h-full z-10">
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
                        onclick="hideModal('confirmation-modal')">
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

    <!-- Success Modal -->
    <div id="booking-success-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div class="relative p-4 w-full max-w-md max-h-full z-10">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Booking Berhasil!
                    </h3>
                    <button type="button" onclick="closeSuccessModal()"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
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
                    <div class="w-12 h-12 rounded-full bg-green-100 mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-5 text-lg font-normal text-gray-500">
                        Booking Anda telah berhasil dikirim! Kami akan menghubungi Anda segera untuk konfirmasi.
                    </h3>
                    <button onclick="closeSuccessModal()" type="button"
                        class="text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        OK, Mengerti
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Global variables for booking modal
        let currentServiceId = null;
        let currentServiceTitle = '';
        let currentServicePrice = 0;

        // Open booking modal
        function openBookingModal(serviceId, serviceTitle, servicePrice) {
            currentServiceId = serviceId;
            currentServiceTitle = serviceTitle;
            currentServicePrice = servicePrice;

            // Pre-select the service in the dropdown
            const serviceSelect = document.getElementById('service-type');
            if (serviceSelect) {
                // Find and select the option that matches the service ID
                for (let i = 0; i < serviceSelect.options.length; i++) {
                    if (serviceSelect.options[i].value == serviceId) {
                        serviceSelect.selectedIndex = i;
                        break;
                    }
                }
            }

            // Set minimum date to today
            const today = new Date().toISOString().split('T')[0];
            const startDateInput = document.getElementById('start-date');
            const endDateInput = document.getElementById('end-date');

            if (startDateInput && endDateInput) {
                startDateInput.min = today;
                endDateInput.min = today;
            }

            // Show modal with proper display
            showModal('booking-modal');
        }

        // Close booking modal
        function closeBookingModal() {
            hideModal('booking-modal');

            // Reset form
            document.getElementById('booking-form').reset();
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

        // Close success modal
        function closeSuccessModal() {
            hideModal('booking-success-modal');
        }

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
                    const basePrice = parseInt(selectedOption.dataset.price) || currentServicePrice ||
                        1000000; // Use current service price or default

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
                    // Get WhatsApp number from contact data (remove non-numeric characters)
                    const whatsappNumber = '{{ preg_replace('/[^0-9]/', '', $contactData['whatsapp']) }}';
                    window.open(`https://wa.me/${whatsappNumber}?text=${whatsappMessage}`, '_blank');

                    // Close the modal after opening WhatsApp
                    hideModal('confirmation-modal');
                });
            }

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
@endsection
