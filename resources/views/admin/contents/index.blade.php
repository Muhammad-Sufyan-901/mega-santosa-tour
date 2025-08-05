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
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Manajemen
                                    Konten</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Manajemen Konten</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola konten halaman website Anda</p>
            </div>
        </div>
    </div>

    <div class="p-6">
        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="mb-4 p-4 text-sm text-green-800 bg-green-50 rounded-lg dark:bg-green-800 dark:text-white">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-4 text-sm text-red-800 bg-red-50 rounded-lg dark:bg-red-800 dark:text-white">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabs Navigation -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-6">
            <div class="">
                <nav class="-mb-px flex space-x-8 px-6 overflow-x-auto" aria-label="Tabs">
                    <button onclick="switchTab('home')" id="tab-home"
                        class="tab-button inline-flex items-center active border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm dark:text-gray-400 dark:hover:text-gray-300">
                        <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg>
                        Home
                    </button>
                    <button onclick="switchTab('services')" id="tab-services"
                        class="tab-button inline-flex items-center border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm dark:text-gray-400 dark:hover:text-gray-300">
                        <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Services
                    </button>
                    <button onclick="switchTab('about')" id="tab-about"
                        class="tab-button inline-flex items-center border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm dark:text-gray-400 dark:hover:text-gray-300">
                        <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        About
                    </button>
                    <button onclick="switchTab('testimonials')" id="tab-testimonials"
                        class="tab-button inline-flex items-center border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm dark:text-gray-400 dark:hover:text-gray-300">
                        <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Testimonials
                    </button>
                    <button onclick="switchTab('gallery')" id="tab-gallery"
                        class="tab-button inline-flex items-center border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm dark:text-gray-400 dark:hover:text-gray-300">
                        <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Gallery
                    </button>
                    <button onclick="switchTab('contact')" id="tab-contact"
                        class="tab-button inline-flex items-center border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm dark:text-gray-400 dark:hover:text-gray-300">
                        <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        Contact
                    </button>
                    <button onclick="switchTab('seo')" id="tab-seo"
                        class="tab-button inline-flex items-center border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm dark:text-gray-400 dark:hover:text-gray-300">
                        <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                        SEO & Meta
                    </button>
                    <button onclick="switchTab('branding')" id="tab-branding"
                        class="tab-button inline-flex items-center border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm dark:text-gray-400 dark:hover:text-gray-300">
                        <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Branding
                    </button>
                </nav>
            </div>
        </div>

        <!-- Tab Content -->
        <!-- Home Tab (Jumbotron) -->
        <div id="content-home" class="tab-content">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Konten Jumbotron/Hero</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Kelola konten hero section di halaman utama</p>
                    </div>

                    <form action="{{ route('admin.content.update.home') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Jumbotron Title -->
                            <div>
                                <label for="jumbotron_title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Judul Jumbotron <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="jumbotron_title" id="jumbotron_title" required
                                    value="{{ old('jumbotron_title', $content->jumbotron_title ?? '') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan judul jumbotron">
                            </div>

                            <!-- Jumbotron Description -->
                            <div>
                                <label for="jumbotron_description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Deskripsi Jumbotron <span class="text-red-500">*</span>
                                </label>
                                <textarea rows="5"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white "
                                    name="jumbotron_description" id="jumbotron_description" required>{{ old('jumbotron_description', $content->jumbotron_description ?? '') }}</textarea>
                            </div>

                            <!-- Jumbotron Image -->
                            <div>
                                <label for="jumbotron_image"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Gambar Jumbotron
                                </label>

                                @if ($content->jumbotron_image ?? false)
                                    <div class="mb-3">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Gambar saat ini:</p>
                                        <img src="{{ asset('assets/images/jumbotron/' . $content->jumbotron_image) }}"
                                            alt="Current Jumbotron"
                                            class="w-32 h-20 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                                    </div>
                                @endif

                                <input type="file" name="jumbotron_image" id="jumbotron_image" accept="image/*"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    onchange="previewImage(this, 'jumbotron-preview')">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG atau JPEG (MAX. 2MB)</p>
                                <div id="jumbotron-preview" class="mt-2 hidden">
                                    <img src="/placeholder.svg" alt="Jumbotron Preview"
                                        class="w-32 h-20 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <button type="submit"
                                class="px-6 py-2.5 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Simpan Konten Jumbotron
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Services Tab -->
        <div id="content-services" class="tab-content hidden">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Konten Section Services</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Kelola konten section layanan</p>
                    </div>

                    <form action="{{ route('admin.content.update.services') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Service Section Title -->
                            <div>
                                <label for="service_section_title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Judul Section Services <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="service_section_title" id="service_section_title" required
                                    value="{{ old('service_section_title', $content->service_section_title ?? '') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan judul section services">
                            </div>

                            <!-- Service Section Description -->
                            <div>
                                <label for="service_section_description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Deskripsi Section Services
                                </label>
                                <textarea name="service_section_description" id="service_section_description" rows="4"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan deskripsi section services">{{ old('service_section_description', $content->service_section_description ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <button type="submit"
                                class="px-6 py-2.5 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Simpan Konten Services
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- About Tab -->
        <div id="content-about" class="tab-content hidden">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Konten Section About</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Kelola konten section tentang kami</p>
                    </div>

                    <form action="{{ route('admin.content.update.about') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <!-- About Section Title -->
                            <div>
                                <label for="about_section_title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Judul Section About <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="about_section_title" id="about_section_title" required
                                    value="{{ old('about_section_title', $content->about_section_title ?? '') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan judul section about">
                            </div>

                            <!-- About Section Text -->
                            <div>
                                <label for="about_section_text"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Teks Section About <span class="text-red-500">*</span>
                                </label>
                                <textarea name="about_section_text" id="about_section_text" required>{{ old('about_section_text', $content->about_section_text ?? '') }}</textarea>
                            </div>

                            <!-- About Image -->
                            <div>
                                <label for="about_image"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Gambar Section About
                                </label>

                                @if ($content->about_image ?? false)
                                    <div class="mb-3">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Gambar saat ini:</p>
                                        <img src="{{ asset('assets/images/about/' . $content->about_image) }}"
                                            alt="Current About Image"
                                            class="w-32 h-20 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                                    </div>
                                @endif

                                <input type="file" name="about_image" id="about_image" accept="image/*"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    onchange="previewImage(this, 'about-preview')">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG atau JPEG (MAX. 2MB)</p>
                                <div id="about-preview" class="mt-2 hidden">
                                    <img src="/placeholder.svg" alt="About Preview"
                                        class="w-32 h-20 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <button type="submit"
                                class="px-6 py-2.5 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Simpan Konten About
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Testimonials Tab -->
        <div id="content-testimonials" class="tab-content hidden">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Konten Section Testimonials
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Kelola konten section testimonial</p>
                    </div>

                    <form action="{{ route('admin.content.update.testimonials') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Testimonial Section Title -->
                            <div>
                                <label for="testimonial_section_title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Judul Section Testimonials <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="testimonial_section_title" id="testimonial_section_title"
                                    required
                                    value="{{ old('testimonial_section_title', $content->testimonial_section_title ?? '') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan judul section testimonials">
                            </div>

                            <!-- Testimonial Description -->
                            <div>
                                <label for="testimonial_description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Deskripsi Section Testimonials
                                </label>
                                <textarea name="testimonial_description" id="testimonial_description" rows="4"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan deskripsi section testimonials">{{ old('testimonial_description', $content->testimonial_description ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <button type="submit"
                                class="px-6 py-2.5 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Simpan Konten Testimonials
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Gallery Tab -->
        <div id="content-gallery" class="tab-content hidden">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Konten Section Gallery</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Kelola konten section galeri</p>
                    </div>

                    <form action="{{ route('admin.content.update.gallery') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Gallery Section Title -->
                            <div>
                                <label for="gallery_section_title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Judul Section Gallery <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="gallery_section_title" id="gallery_section_title" required
                                    value="{{ old('gallery_section_title', $content->gallery_section_title ?? '') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan judul section gallery">
                            </div>

                            <!-- Gallery Section Description -->
                            <div>
                                <label for="gallery_section_description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Deskripsi Section Gallery
                                </label>
                                <textarea name="gallery_section_description" id="gallery_section_description" rows="4"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan deskripsi section gallery">{{ old('gallery_section_description', $content->gallery_section_description ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <button type="submit"
                                class="px-6 py-2.5 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Simpan Konten Gallery
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contact Tab -->
        <div id="content-contact" class="tab-content hidden">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Konten Section Contact</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Kelola konten section kontak dan informasi
                            sosial media</p>
                    </div>

                    <form action="{{ route('admin.content.update.contact') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Contact Section Title -->
                            <div>
                                <label for="contact_section_title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Judul Section Contact <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="contact_section_title" id="contact_section_title" required
                                    value="{{ old('contact_section_title', $content->contact_section_title ?? '') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan judul section contact">
                            </div>

                            <!-- WhatsApp -->
                            <div>
                                <label for="whatsapp"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    WhatsApp
                                </label>
                                <input type="text" name="whatsapp" id="whatsapp"
                                    value="{{ old('whatsapp', $content->whatsapp ?? '') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="+62 812-3456-7890">
                            </div>

                            <!-- Instagram -->
                            <div>
                                <label for="instagram"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Instagram (Username)
                                </label>
                                <input type="text" name="instagram" id="instagram"
                                    value="{{ old('instagram', $content->instagram ?? '') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="username">
                            </div>

                            <!-- TikTok -->
                            <div>
                                <label for="tiktok"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    TikTok (Username)
                                </label>
                                <input type="text" name="tiktok" id="tiktok"
                                    value="{{ old('tiktok', $content->tiktok ?? '') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="username">
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" id="email" required
                                    value="{{ old('email', $content->email ?? '') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="info@company.com">
                            </div>

                            <!-- Google Maps -->
                            <div>
                                <label for="google_maps"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Google Maps Embed URL
                                </label>
                                <input type="url" name="google_maps" id="google_maps"
                                    value="{{ old('google_maps', $content->google_maps ?? '') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="https://www.google.com/maps/embed?pb=...">
                            </div>

                            <!-- Address -->
                            <div>
                                <label for="address"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Alamat
                                </label>
                                <textarea name="address" id="address" rows="4"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan alamat">{{ old('address', $content->address ?? '') }}</textarea>
                            </div>

                            <!-- Contact Section Description -->
                            <div>
                                <label for="contact_section_description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Deskripsi Section Contact
                                </label>
                                <textarea name="contact_section_description" id="contact_section_description" rows="4"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan deskripsi section contact">{{ old('contact_section_description', $content->contact_section_description ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <button type="submit"
                                class="px-6 py-2.5 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Simpan Konten Contact
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- SEO & Meta Tab -->
        <div id="content-seo" class="tab-content hidden">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">SEO & Meta Information</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Kelola informasi SEO dan meta tags website</p>
                    </div>

                    <form action="{{ route('admin.content.update.seo') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Meta Title -->
                            <div>
                                <label for="meta_title"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Meta Title <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="meta_title" id="meta_title" required
                                    value="{{ old('meta_title', $content->meta_title ?? '') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan meta title">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Maksimal 60 karakter untuk hasil
                                    optimal di search engine</p>
                            </div>

                            <!-- Meta Keywords -->
                            <div>
                                <label for="meta_keyword"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Meta Keywords
                                </label>
                                <textarea name="meta_keyword" id="meta_keyword" rows="3"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="keyword1, keyword2, keyword3">{{ old('meta_keyword', $content->meta_keyword ?? '') }}</textarea>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Pisahkan dengan koma untuk
                                    multiple keywords</p>
                            </div>

                            <!-- Meta Description -->
                            <div>
                                <label for="meta_description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Meta Description <span class="text-red-500">*</span>
                                </label>
                                <textarea name="meta_description" id="meta_description" rows="4" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan meta description">{{ old('meta_description', $content->meta_description ?? '') }}</textarea>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Maksimal 160 karakter untuk hasil
                                    optimal di search engine</p>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <button type="submit"
                                class="px-6 py-2.5 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Simpan SEO & Meta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Branding Tab -->
        <div id="content-branding" class="tab-content hidden">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Branding & Logo</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Kelola logo dan favicon website</p>
                    </div>

                    <form action="{{ route('admin.content.update.branding') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Logo -->
                            <div>
                                <label for="logo"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Logo Website
                                </label>

                                @if ($content->logo ?? false)
                                    <div class="mb-3">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Logo saat ini:</p>
                                        <img src="{{ asset('assets/images/logo/' . $content->logo) }}" alt="Current Logo"
                                            class="w-32 h-20 object-contain rounded-lg border border-gray-300 dark:border-gray-600 bg-white">
                                    </div>
                                @endif

                                <input type="file" name="logo" id="logo" accept="image/*"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    onchange="previewImage(this, 'logo-preview')">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG, JPEG, atau SVG (MAX.
                                    2MB)</p>
                                <div id="logo-preview" class="mt-2 hidden">
                                    <img src="/placeholder.svg" alt="Logo Preview"
                                        class="w-32 h-20 object-contain rounded-lg border border-gray-300 dark:border-gray-600 bg-white">
                                </div>
                            </div>

                            <!-- Favicon -->
                            <div>
                                <label for="favicon"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Favicon
                                </label>

                                @if ($content->favicon ?? false)
                                    <div class="mb-3">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Favicon saat ini:</p>
                                        <img src="{{ asset('assets/images/favicon/' . $content->favicon) }}"
                                            alt="Current Favicon"
                                            class="w-8 h-8 object-contain rounded border border-gray-300 dark:border-gray-600 bg-white">
                                    </div>
                                @endif

                                <input type="file" name="favicon" id="favicon" accept="image/*,.ico"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    onchange="previewImage(this, 'favicon-preview')">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">ICO, PNG, atau JPG (MAX. 1MB,
                                    ukuran ideal 32x32px)</p>
                                <div id="favicon-preview" class="mt-2 hidden">
                                    <img src="/placeholder.svg" alt="Favicon Preview"
                                        class="w-8 h-8 object-contain rounded border border-gray-300 dark:border-gray-600 bg-white">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <button type="submit"
                                class="px-6 py-2.5 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Simpan Branding
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .note-editor.note-frame {
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
        }

        .dark .note-editor.note-frame {
            border-color: #4b5563;
            background-color: #374151;
        }

        .dark .note-editing-area {
            background-color: #374151;
            color: #f9fafb;
        }

        /* Dark theme toolbar styling */
        .dark .note-toolbar {
            background-color: #1f2937 !important;
            border-bottom: 1px solid #4b5563 !important;
        }

        .dark .note-toolbar .note-btn-group {
            border-color: #4b5563 !important;
        }

        .dark .note-toolbar .note-btn {
            color: #f9fafb !important;
            background-color: transparent !important;
            border-color: #4b5563 !important;
        }

        .dark .note-toolbar .note-btn:hover {
            background-color: #374151 !important;
            color: #ffffff !important;
        }

        .dark .note-toolbar .note-btn:focus {
            background-color: #374151 !important;
            color: #ffffff !important;
        }

        .dark .note-toolbar .note-btn.active {
            background-color: #4b5563 !important;
            color: #ffffff !important;
        }

        .dark .note-toolbar .note-dropdown-toggle:after {
            color: #f9fafb !important;
        }

        .dark .note-toolbar .note-color .note-recent-color,
        .dark .note-toolbar .note-color .note-color-palette {
            background-color: #374151 !important;
            border-color: #4b5563 !important;
        }

        /* Dropdown menus in dark mode */
        .dark .note-dropdown-menu {
            background-color: #374151 !important;
            border-color: #4b5563 !important;
        }

        .dark .note-dropdown-menu .note-dropdown-item {
            color: #f9fafb !important;
        }

        .dark .note-dropdown-menu .note-dropdown-item:hover {
            background-color: #4b5563 !important;
            color: #ffffff !important;
        }

        /* Style select elements */
        .dark .note-toolbar select {
            background-color: #374151 !important;
            color: #f9fafb !important;
            border-color: #4b5563 !important;
        }

        .dark .note-toolbar select option {
            background-color: #374151 !important;
            color: #f9fafb !important;
        }

        /* Modal dialogs in dark mode */
        .dark .modal-content {
            background-color: #374151 !important;
            color: #f9fafb !important;
        }

        .dark .modal-header {
            border-bottom-color: #4b5563 !important;
        }

        .dark .modal-footer {
            border-top-color: #4b5563 !important;
        }

        /* Input fields in modals */
        .dark .modal-content input,
        .dark .modal-content textarea {
            background-color: #1f2937 !important;
            color: #f9fafb !important;
            border-color: #4b5563 !important;
        }

        .dark .modal-content input:focus,
        .dark .modal-content textarea:focus {
            border-color: #6b7280 !important;
        }

        /* Tab styling */
        .tab-button {
            position: relative;
            transition: all 0.3s ease;
        }

        .tab-button.active {
            border-bottom-color: #3b82f6 !important;
            color: #3b82f6 !important;
            border-bottom-width: 2px !important;
        }

        .dark .tab-button.active {
            border-bottom-color: #60a5fa !important;
            color: #60a5fa !important;
            border-bottom-width: 2px !important;
        }

        .tab-button:not(.active) {
            border-bottom-color: transparent !important;
            border-bottom-width: 2px !important;
        }

        .tab-button:not(.active):hover {
            border-bottom-color: #d1d5db !important;
            color: #374151 !important;
        }

        .dark .tab-button:not(.active):hover {
            border-bottom-color: #4b5563 !important;
            color: #f3f4f6 !important;
        }
    </style>
@endpush

@push('js')
    <!-- jQuery (required for Summernote) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        // Function to check if dark mode is active
        function isDarkMode() {
            return document.documentElement.classList.contains('dark') ||
                window.matchMedia('(prefers-color-scheme: dark)').matches;
        }

        // Function to initialize Summernote with proper theme
        function initSummernote() {
            const summernoteConfig = {
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onInit: function() {
                        if (isDarkMode()) {
                            applyDarkTheme();
                        }
                    }
                }
            };

            // Initialize all Summernote textareas
            // $('#jumbotron_description').summernote({
            //     ...summernoteConfig,
            //     placeholder: 'Masukkan deskripsi jumbotron...'
            // });

            // $('#service_section_description').summernote({
            //     ...summernoteConfig,
            //     placeholder: 'Masukkan deskripsi section services...'
            // });

            $('#about_section_text').summernote({
                ...summernoteConfig,
                placeholder: 'Masukkan teks section about...'
            });

            // $('#testimonial_description').summernote({
            //     ...summernoteConfig,
            //     placeholder: 'Masukkan deskripsi section testimonials...'
            // });

            // $('#gallery_section_description').summernote({
            //     ...summernoteConfig,
            //     placeholder: 'Masukkan deskripsi section gallery...'
            // });

            // $('#contact_section_description').summernote({
            //     ...summernoteConfig,
            //     placeholder: 'Masukkan deskripsi section contact...'
            // });
        }

        // Function to apply dark theme to Summernote
        function applyDarkTheme() {
            const $noteEditor = $('.note-editor');
            const $noteToolbar = $('.note-toolbar');
            const $noteEditingArea = $('.note-editing-area');

            $noteEditor.addClass('dark-theme');
            $noteToolbar.addClass('dark-theme');
            $noteEditingArea.addClass('dark-theme');
        }

        // Function to remove dark theme from Summernote
        function removeDarkTheme() {
            const $noteEditor = $('.note-editor');
            const $noteToolbar = $('.note-toolbar');
            const $noteEditingArea = $('.note-editing-area');

            $noteEditor.removeClass('dark-theme');
            $noteToolbar.removeClass('dark-theme');
            $noteEditingArea.removeClass('dark-theme');
        }

        // Tab switching function
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active');
                button.style.borderBottomColor = 'transparent';
                button.style.borderBottomWidth = '2px';
            });

            // Show selected tab content
            document.getElementById(`content-${tabName}`).classList.remove('hidden');

            // Add active class to selected tab button
            const activeButton = document.getElementById(`tab-${tabName}`);
            activeButton.classList.add('active');
            activeButton.style.borderBottomColor = '#3b82f6';
            activeButton.style.borderBottomWidth = '2px';
        }

        // Initialize the first tab as active on page load
        document.addEventListener('DOMContentLoaded', function() {
            switchTab('home');
        });

        // Image preview function
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const img = preview.querySelector('img');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.classList.add('hidden');
            }
        }

        $(document).ready(function() {
            // Initialize Summernote
            initSummernote();

            // Watch for theme changes
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        const isDark = isDarkMode();
                        if (isDark) {
                            applyDarkTheme();
                        } else {
                            removeDarkTheme();
                        }
                    }
                });
            });

            // Start observing
            observer.observe(document.documentElement, {
                attributes: true,
                attributeFilter: ['class']
            });

            // Also listen for system theme changes
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
                setTimeout(function() {
                    if (isDarkMode()) {
                        applyDarkTheme();
                    } else {
                        removeDarkTheme();
                    }
                }, 100);
            });
        });

        // Form validation
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('border-red-500');
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Mohon lengkapi semua field yang wajib diisi.');
                }
            });
        });
    </script>
@endpush
