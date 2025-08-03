@extends('layouts.admin_layout')

@section('content')
    <div
        class="px-6 py-8 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
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
                                <a href="{{ route('admin.galleries.index') }}"
                                    class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Galeri</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Detail
                                    Galeri</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="flex items-center justify-between">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Detail Galeri:
                        {{ $gallery->title }}</h1>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.galleries.edit', $gallery->id) }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-900 rounded-lg bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-900">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                </path>
                                <path fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Edit
                        </a>
                        <a href="{{ route('admin.galleries.index') }}"
                            class="px-5 py-2.5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6">
                <div class="space-y-6">
                    <!-- Basic Information -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Judul
                        </div>
                        <div class="md:col-span-2 text-sm text-gray-900 dark:text-white font-semibold">
                            {{ $gallery->title }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Status
                        </div>
                        <div class="md:col-span-2 text-sm text-gray-900 dark:text-white">
                            @if ($gallery->status == 1)
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                    Aktif
                                </span>
                            @else
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                    Nonaktif
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Thumbnail -->
                    @if ($gallery->thumbnail)
                        <div
                            class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Thumbnail
                            </div>
                            <div class="md:col-span-2">
                                <img src="{{ asset('assets/images/galleries/thumbnails/' . $gallery->thumbnail) }}"
                                    alt="Thumbnail" class="w-48 h-32 object-cover rounded-lg border border-gray-300">
                            </div>
                        </div>
                    @endif

                    <!-- Gambar -->
                    @if ($gallery->image)
                        <div
                            class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Gambar
                            </div>
                            <div class="md:col-span-2">
                                <img src="{{ asset('assets/images/galleries/images/' . $gallery->image) }}"
                                    alt="Gallery Image" class="w-48 h-32 object-cover rounded-lg border border-gray-300">
                            </div>
                        </div>
                    @endif

                    <!-- Prolog -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Prolog
                        </div>
                        <div class="md:col-span-2 text-sm text-gray-900 dark:text-white">
                            {{ $gallery->prolog }}
                        </div>
                    </div>

                    <!-- Created At -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            Tanggal Dibuat
                        </div>
                        <div class="md:col-span-2 text-sm text-gray-900 dark:text-white">
                            {{ $gallery->created_at->format('d M Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
