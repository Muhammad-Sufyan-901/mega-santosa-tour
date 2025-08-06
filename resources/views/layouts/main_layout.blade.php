<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mega Santosa Tour | {{ $title ?? 'Home' }}</title>

    <!-- Favicon -->
    @php
        $content = app(App\Http\Controllers\ContentController::class)->getContent();
        $faviconUrl = $content->favicon
            ? asset('assets/images/favicon/' . $content->favicon)
            : asset('assets/images/logo-mega-santosa.png');
        $logoUrl = $content->logo
            ? asset('assets/images/logo/' . $content->logo)
            : asset('assets/images/logo-mega-santosa.png');
    @endphp
    <link rel="icon" type="image/x-icon" href="{{ $faviconUrl }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <script src="{{ asset('js/app.js') }}" defer></script>
    @endif
</head>

<body class="relative bg-gray-50 antialiased">

    {{-- ===== Navbar ===== --}}
    <nav class="bg-white fixed w-full z-[35] top-0 start-0 border-b border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ route('home.index') }}" class="flex items-center space-x-3 rtl:space-x-reverse w-28">
                <img src="{{ $logoUrl }}" class="h-16" alt="Mega Santosa Tour Logo">
                {{-- <span class="self-center text-2xl font-semibold whitespace-nowrap">Tour & Travel</span> --}}
            </a>

            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <a href="#"
                    class="w-[176px] text-white bg-gradient-to-r from-[#48A0CB] to-[#1B5DB9] hover:from-blue-900 hover:to-[#3f87ed] focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-lg text-sm px-6 py-3 text-center inline-flex items-center justify-center">
                    <i class="fa-brands fa-whatsapp mr-2 text-lg"></i> Hubungi Kami
                </a>
                <button data-collapse-toggle="navbar-sticky" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>

            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <a href="{{ route('home.index') }}"
                            class="block py-2 px-3 text-gray-900 font-semibold rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#1B5DB9] md:p-0 {{ $activePage == 'Beranda' ? 'text-white bg-[#1B5DB9] md:bg-transparent md:text-[#1B5DB9]' : '' }}"
                            aria-current="page">Beranda</a>
                    </li>
                    <li>
                        <a href="{{ route('services.index') }}#sewa-mobil"
                            class="block py-2 px-3 text-gray-900 font-semibold rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#1B5DB9] md:p-0 {{ $activePage == 'Layanan' ? 'text-white bg-[#1B5DB9] md:bg-transparent md:text-[#1B5DB9]' : '' }}">Layanan</a>
                    </li>
                    <li>
                        <a href="{{ route('services.index') }}#paket-tour"
                            class="block py-2 px-3 text-gray-900 font-semibold rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#1B5DB9] md:p-0 {{ $activePage == 'Paket' ? 'text-white bg-[#1B5DB9] md:bg-transparent md:text-[#1B5DB9]' : '' }}">Paket</a>
                    </li>
                    <li>
                        <a href="{{ route('galleries.index') }}"
                            class="block py-2 px-3 text-gray-900 font-semibold rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#1B5DB9] md:p-0 {{ $activePage == 'Galeri' ? 'text-white bg-[#1B5DB9] md:bg-transparent md:text-[#1B5DB9]' : '' }}">Galeri</a>
                    </li>
                    <li>
                        <a href="{{ route('contact.index') }}"
                            class="block py-2 px-3 text-gray-900 font-semibold rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#1B5DB9] md:p-0 {{ $activePage == 'Kontak' ? 'text-white bg-[#1B5DB9] md:bg-transparent md:text-[#1B5DB9]' : '' }}">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- ===== Section Title ===== --}}
    @if (isset($sectionTitle) && !empty($sectionTitle))
        <section
            class="h-[35vh] mt-20 bg-cover bg-center bg-no-repeat bg-[url('https://images.unsplash.com/photo-1603878062595-32f9e7eeb9ff?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8bW91bnRhaW4lMjBqZWVwfGVufDB8fDB8fHww')] bg-gray-700 bg-blend-multiply flex items-center">
            <div class="max-w-screen-xl mx-auto px-4 w-full">
                <p class="text-white mb-6">Beranda / <span
                        class="inline-block py-2 px-3 text-white font-semibold bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0">Layanan</span>
                </p>
                <h1 class="text-5xl font-extrabold text-white tracking-tight">
                    {{ $sectionTitle }}
                </h1>
            </div>
        </section>
    @endif

    {{-- ===== Section Content ===== --}}
    @yield('content')

    {{-- ===== Booking & Confirmation Modal ===== --}}
    @include('partials.booking_modals')

    {{-- ===== Add Testimonial Modal ===== --}}
    @include('partials.testimonial_modals')

    {{-- ===== Footer =====  --}}
    <footer class="bg-gradient-to-r from-[#D2EEF8] to-[#1B5DB9]">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="{{ route('home.index') }}" class="flex items-center">
                        <img src="{{ $logoUrl }}" class="h-40 w-40 me-3" alt="Mega Santosa Tour Logo" />
                        {{-- <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Tour &
                            Travel</span> --}}
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-28 sm:grid-cols-2">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-white uppercase">Tautan</h2>
                        <ul class="text-gray-300 font-medium">
                            <li class="mb-4">
                                <a href="{{ route('home.index') }}" class="hover:underline">Beranda</a>
                            </li>
                            <li class="mb-4">
                                <a href="{{ route('services.index') }}#sewa-mobil" class="hover:underline">Layanan</a>
                            </li>
                            <li class="mb-4">
                                <a href="{{ route('services.index') }}#paket-tour" class="hover:underline">Paket</a>
                            </li>
                            </li>
                            <li class="mb-4">
                                <a href="{{ route('galleries.index') }}" class="hover:underline">Galeri</a>
                            </li>
                            <li>
                                <a href="{{ route('contact.index') }}" class="hover:underline">Kontak</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-white uppercase">Ikuti Kami</h2>
                        <ul class="text-gray-300 font-medium">
                            @if (isset($contactData['tiktok']) && !empty($contactData['tiktok']))
                                <li class="mb-4">
                                    <a href="{{ 'https://www.tiktok.com/@' . $contactData['tiktok'] }}"
                                        class="hover:underline ">Tiktok</a>
                                </li>
                            @endif
                            <li class="mb-4">
                                <a href="https://instagram.com/{{ $contactData['instagram'] }}"
                                    class="hover:underline">Instagram</a>
                            </li>
                            <li>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactData['whatsapp']) }}"
                                    class="hover:underline">Whatsapp</a>
                            </li>
                        </ul>
                    </div>
                    {{-- <div>
                        <h2 class="mb-6 text-sm font-semibold text-white uppercase">Legal</h2>
                        <ul class="text-gray-300 font-medium">
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Terms & Conditions</a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500 sm:text-center">© {{ date('Y') }} <a
                        href="{{ route('home.index') }}" class="hover:underline">Mega Santosa Tour</a>. All Rights
                    Reserved.
                </span>
                <div class="flex mt-4 sm:justify-center sm:mt-0">
                    <a href="https://instagram.com/{{ $contactData['instagram'] }}"
                        class="text-gray-300 hover:text-gray-900">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M13.545 0h-7.09C2.923 0 0 2.923 0 6.455v7.09C0 17.077 2.923 20 6.455 20h7.09C17.077 20 20 17.077 20 13.545v-7.09C20 2.923 17.077 0 13.545 0ZM18.182 13.545c0 2.545-2.092 4.637-4.637 4.637h-7.09c-2.545 0-4.637-2.092-4.637-4.637v-7.09c0-2.545 2.092-4.637 4.637-4.637h7.09c2.545 0 4.637 2.092 4.637 4.637v7.09ZM10 4.864a5.136 5.136 0 1 0 0 10.272 5.136 5.136 0 0 0 0-10.272Zm0 8.455a3.319 3.319 0 1 1 0-6.638 3.319 3.319 0 0 1 0 6.638Zm5.338-9.091a1.227 1.227 0 1 1-2.454 0 1.227 1.227 0 0 1 2.454 0Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Instagram page</span>
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactData['whatsapp']) }}"
                        class="text-gray-300 hover:text-gray-900 ms-5">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10.047 0C4.504 0 0 4.504 0 10.047c0 1.787.468 3.466 1.283 4.924L.445 19.531a.447.447 0 0 0 .56.56l4.56-1.84a9.955 9.955 0 0 0 4.482 1.064c5.543 0 10.047-4.504 10.047-10.047S15.59 0 10.047 0ZM15.38 13.64c-.244.695-1.433 1.274-1.972 1.36-.536.086-1.207.078-1.949-.122-.45-.121-.997-.283-1.714-.554-3.013-1.138-4.98-4.152-5.129-4.343-.148-.191-1.207-1.606-1.207-3.065 0-1.459.765-2.177 1.037-2.475.272-.298.594-.373.793-.373.198 0 .396.009.569.017.182.009.426-.07.666.509.244.588.829 2.017.901 2.164.072.147.12.318.024.509-.096.191-.144.31-.289.475-.144.165-.304.368-.435.494-.144.139-.294.289-.126.567.168.279.747 1.233 1.604 1.996 1.101.98 2.031 1.283 2.318 1.427.287.144.454.12.62-.072.165-.191.708-.826.897-1.109.188-.283.377-.236.635-.142.258.095 1.64.773 1.923.914.283.141.472.212.54.33.069.118.069.683-.175 1.378Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">WhatsApp</span>
                    </a>
                    @if (isset($contactData['tiktok']) && !empty($contactData['tiktok']))
                        <a href="{{ 'https://www.tiktok.com/@' . $contactData['tiktok'] }}"
                            class="text-gray-300 hover:text-gray-900 ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M18.6216 3.21667c.2391.1897.3784.47817.3784.78334V15.6667c0 .0412-.0025.0818-.0073.1218.0048.0698.0073.1404.0073.2115 0 1.6569-1.3431 3-3 3s-3-1.3431-3-3 1.3431-3 3-3c.3506 0 .6872.0602 1 .1707V9.2602l-8 1.8667V18l-.00001.0032C8.99824 19.6586 7.65577 21 6 21c-1.65685 0-3-1.3431-3-3s1.34315-3 3-3c.35064 0 .68722.0602 1 .1707V6.33334c0-.46474.32018-.86823.77277-.97384l9.99953-2.33321c.1486-.03477.3012-.03465.4467-.00201.1427.03202.2783.09532.3964.18752.0021.00162.0041.00324.0062.00487Z" />
                            </svg>

                            <span class="sr-only">TikTok page</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    {{-- ===== Scripts ===== --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
