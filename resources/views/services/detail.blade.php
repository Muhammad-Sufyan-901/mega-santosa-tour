@extends('layouts.main_layout')

@section('content')
    <section class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="flex w-full gap-[2.5%] h-96 overflow-hidden">
            <!-- Main Image Container -->
            <div class="w-[70%]">
                @if ($service->thumbnail)
                    <img id="mainImage" src="{{ asset('assets/images/services/' . $service->thumbnail) }}"
                        alt="{{ $service->title }}"
                        class="w-full h-full object-cover rounded-2xl transition-all duration-300 ease-in-out">
                @elseif($service->images->count() > 0)
                    <img id="mainImage" src="{{ asset('assets/images/services/' . $service->images->first()->image) }}"
                        alt="{{ $service->title }}"
                        class="w-full h-full object-cover rounded-2xl transition-all duration-300 ease-in-out">
                @else
                    <div class="w-full h-full bg-gray-200 rounded-2xl flex items-center justify-center">
                        <span class="text-gray-500">No Image Available</span>
                    </div>
                @endif
            </div>

            <!-- Thumbnail Images Container -->
            <div
                class="w-[27.5%] flex flex-col gap-y-3 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">

                @php
                    $allImages = collect();
                    if ($service->thumbnail) {
                        $allImages->push(
                            (object) [
                                'image' => $service->thumbnail,
                                'type' => 'thumbnail',
                            ],
                        );
                    }
                    $allImages = $allImages->merge(
                        $service->images->map(function ($img) {
                            return (object) [
                                'image' => $img->image,
                                'type' => 'gallery',
                            ];
                        }),
                    );
                @endphp

                @if ($allImages->count() > 0)
                    @foreach ($allImages as $index => $image)
                        <div class="thumbnail-container cursor-pointer">
                            <img src="{{ asset('assets/images/services/' . $image->image) }}"
                                alt="{{ $service->title }} {{ $index + 1 }}"
                                class="thumbnail-img w-full h-36 object-cover rounded-2xl hover:opacity-80 transition-opacity duration-200 border-2 {{ $index === 0 ? 'border-blue-500' : 'border-transparent' }}"
                                data-full-img="{{ asset('assets/images/services/' . $image->image) }}">
                        </div>
                    @endforeach
                @else
                    <div class="w-full h-36 bg-gray-200 rounded-2xl flex items-center justify-center">
                        <span class="text-gray-500 text-sm">No Images</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-10">
            <h1 class="text-5xl font-black text-[#1B5DB9]">{{ $service->title }}</h1>
            <h3 class="text-3xl font-bold text-gray-900 mt-4">Rp {{ number_format($service->price, 0, ',', '.') }}</h3>

            {{-- Rating section (hidden as requested)
            <div class="mt-5 flex items-center gap-x-3">
                <div class="inline-flex items-center text-yellow-400 gap-2">
                    @for ($s = 0; $s < 5; $s++)
                        <i class="fa-solid fa-star text-xl"></i>
                    @endfor
                </div>
                <span class="text-gray-500 inline-block">4.9/5</span>
            </div>
            --}}

            <div class="grid grid-cols-2 gap-6 w-full mt-5">
                <div class="w-full">
                    <h5 class="text-xl font-bold text-gray-900">Detail Layanan</h5>

                    <div class="mt-5 text-[#1B5DB9]">
                        {!! $service->detail !!}
                    </div>
                </div>

                @if ($service->travel_plan)
                    <div class="w-full">
                        <h5 class="text-xl font-bold text-gray-900">Rencana Perjalanan</h5>

                        <p class="mt-5 text-[#1B5DB9]">
                            {!! $service->travel_plan !!}
                        </p>
                    </div>
                @endif

                @if ($service->includes->count() > 0)
                    <div class="w-full">
                        <h5 class="text-xl font-bold text-gray-900">Termasuk :</h5>

                        <ul class="mt-5 ml-4 flex flex-col gap-y-2.5 list-['✅']">
                            @foreach ($service->includes as $include)
                                <li class="text-[#1B5DB9] pl-2">
                                    {{ $include->include }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($service->excludes->count() > 0)
                    <div class="w-full">
                        <h5 class="text-xl font-bold text-gray-900">Tidak Termasuk :</h5>

                        <ul class="mt-5 ml-4 flex flex-col gap-y-2.5 list-['❌']">
                            @foreach ($service->excludes as $exclude)
                                <li class="text-[#1B5DB9] pl-2">
                                    {{ $exclude->exclude }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($service->requirements->count() > 0)
                    <div class="w-full col-span-2">
                        <h5 class="text-xl font-bold text-gray-900">Syarat & Ketentuan :</h5>

                        <ul class="mt-5 ml-4 flex flex-col gap-y-2.5">
                            @foreach ($service->requirements as $requirement)
                                <li class="text-[#1B5DB9] pl-2 list-['📋']">
                                    {{ $requirement->requirement }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <button data-modal-target="booking-modal" data-modal-toggle="booking-modal" type="button"
                class="mt-6 text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm px-6 py-3 text-center inline-flex items-center justify-center cursor-pointer"
                data-service-id="{{ $service->id }}" data-service-type="service"
                data-service-name="{{ $service->title }}">
                <i class="fa-brands fa-whatsapp mr-2 text-lg"></i> Pesan Sekarang
            </button>
        </div>
    </section>

    <section class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="max-w-screen-md mx-auto text-center mb-8 lg:mb-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">
                Layanan Lainnya
            </h2>
            <p class="mb-5 font-light text-gray-500 sm:text-xl">
                "Kami menyediakan layanan sewa mobil dan paket tour terbaik untuk perjalanan nyaman dan seru bersama
                kami!"
            </p>
        </div>

        <div class="flex justify-between items-center mb-6">
            <h3 class="text-3xl tracking-tight font-extrabold text-gray-900">
                Layanan Lainnya
            </h3>

            <a href="{{ route('services.index') }}"
                class="inline-flex items-center text-lg font-medium text-[#1B5DB9] hover:underline">
                Semua Layanan
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-3 gap-3 mb-16">
            @if ($otherServices->count() > 0)
                @foreach ($otherServices->take(3) as $otherService)
                    <div class="max-w-sm bg-white border border-gray-200 rounded-4xl shadow-sm">
                        <a href="{{ route('services.detail', $otherService->id) }}">
                            @if ($otherService->thumbnail)
                                <img class="rounded-t-4xl w-full h-64 object-cover"
                                    src="{{ asset('assets/images/services/' . $otherService->thumbnail) }}"
                                    alt="{{ $otherService->title }}" />
                            @elseif($otherService->images->count() > 0)
                                <img class="rounded-t-4xl w-full h-64 object-cover"
                                    src="{{ asset('assets/images/services/' . $otherService->images->first()->image) }}"
                                    alt="{{ $otherService->title }}" />
                            @else
                                <div class="rounded-t-4xl w-full h-64 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                        </a>
                        <div class="p-5 text-center">
                            <a href="{{ route('services.detail', $otherService->id) }}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                    {{ $otherService->title }}
                                </h5>
                            </a>
                            <p class="mb-3 font-medium text-gray-700">
                                Mulai Dari <span class="font-semibold">IDR
                                    {{ number_format($otherService->price, 0, ',', '.') }}</span>
                            </p>
                            <p class="mb-3 font-normal text-sm text-gray-700 italic">
                                "{{ Str::limit($otherService->prolog, 120) }}"
                            </p>
                            <a href="{{ route('services.detail', $otherService->id) }}"
                                class="w-full inline-flex justify-center items-center px-3 py-4 text-sm font-medium text-center text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full">
                                Lihat Detail
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500">Tidak ada layanan lain yang tersedia.</p>
                </div>
            @endif
        </div>


    </section>

    <section class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="max-w-screen-md mx-auto text-center mb-8 lg:mb-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900">
                Apa Kata Klien Kami
            </h2>
            <p class="mb-5 font-light text-gray-500 sm:text-xl">
                "Kami selalu berusaha memberikan layanan terbaik untuk kepuasan klien kami. Berikut adalah beberapa
                testimoni dari klien yang telah menggunakan layanan kami."
            </p>
        </div>

        @php
            // Get testimonials for this page
            $testimonials = \App\Models\Testimonial::where('status', 'active')
                ->where('is_verified', true)
                ->latest()
                ->limit(9)
                ->get();
            $testimonialSlides = $testimonials->chunk(3);
        @endphp

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

    <style>
        /* Custom scrollbar styles */
        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }

        .scrollbar-thumb-gray-300::-webkit-scrollbar-thumb {
            background-color: #d1d5db;
            border-radius: 3px;
        }

        .scrollbar-track-gray-100::-webkit-scrollbar-track {
            background-color: #f3f4f6;
            border-radius: 3px;
        }

        .scrollbar-thumb-gray-300::-webkit-scrollbar-thumb:hover {
            background-color: #9ca3af;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainImage = document.getElementById('mainImage');
            const thumbnails = document.querySelectorAll('.thumbnail-img');

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    // Update main image source
                    const newImageSrc = this.getAttribute('data-full-img');
                    const newImageAlt = this.getAttribute('alt');

                    mainImage.src = newImageSrc;
                    mainImage.alt = newImageAlt;

                    // Remove active border from all thumbnails
                    thumbnails.forEach(thumb => {
                        thumb.classList.remove('border-blue-500');
                        thumb.classList.add('border-transparent');
                    });

                    // Add active border to clicked thumbnail
                    this.classList.remove('border-transparent');
                    this.classList.add('border-blue-500');
                });
            });
        });
    </script>
@endsection
