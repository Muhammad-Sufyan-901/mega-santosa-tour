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
                                <a href="{{ route('admin.services.index') }}"
                                    class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Layanan</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Edit
                                    Layanan</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Edit Data Layanan</h1>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="p-6">
                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div
                        class="mb-4 p-4 text-sm text-green-800 bg-green-50 rounded-lg dark:bg-green-800 dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 p-4 text-sm text-red-800 bg-red-50 rounded-lg dark:bg-red-800 dark:text-red-200">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.services.update', $service->id) }}" method="POST"
                    enctype="multipart/form-data" id="service-form">
                    @csrf
                    @method('PUT')

                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="mb-4 p-4 text-sm text-red-800 bg-red-50 rounded-lg dark:bg-red-800 dark:text-red-200">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Layanan -->
                        <div class="col-span-2">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Nama Layanan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title', $service->title) }}"
                                required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Masukkan nama layanan">
                        </div>

                        <!-- Jenis Layanan -->
                        <div>
                            <label for="type_of_service"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Jenis Layanan <span class="text-red-500">*</span>
                            </label>
                            <select name="type_of_service" id="type_of_service" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="">Pilih Jenis Layanan</option>
                                <option value="Sewa Mobil"
                                    {{ old('type_of_service', $service->type_of_service) == 'Sewa Mobil' ? 'selected' : '' }}>
                                    Sewa Mobil</option>
                                <option value="Paket Tour"
                                    {{ old('type_of_service', $service->type_of_service) == 'Paket Tour' ? 'selected' : '' }}>
                                    Paket Tour</option>
                            </select>
                        </div>

                        <!-- Harga -->
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Harga <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-gray-500 dark:text-gray-400">Rp</span>
                                <input type="number" name="price" id="price"
                                    value="{{ old('price', $service->price) }}" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="0">
                            </div>
                        </div>

                        <!-- Prolog -->
                        <div>
                            <label for="prolog" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Prolog <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="prolog" id="prolog"
                                value="{{ old('prolog', $service->prolog) }}" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Masukkan deskripsi singkat layanan">
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Status
                            </label>
                            <select name="status" id="status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="active" {{ old('status', $service->status) == 'active' ? 'selected' : '' }}>
                                    Aktif</option>
                                <option value="inactive"
                                    {{ old('status', $service->status) == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>

                        <!-- Thumbnail -->
                        <div>
                            <label for="thumbnail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Thumbnail
                            </label>

                            <!-- Current Thumbnail -->
                            @if ($service->thumbnail)
                                <div class="mb-3">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Thumbnail saat ini:</p>
                                    <img src="{{ asset('assets/images/services/' . $service->thumbnail) }}"
                                        alt="Current Thumbnail"
                                        class="w-20 h-20 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                                </div>
                            @endif

                            <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                onchange="previewThumbnail(this)">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG atau JPEG (MAX. 2MB).
                                Kosongkan jika tidak ingin mengubah thumbnail.</p>

                            <div id="thumbnail-preview" class="mt-2 hidden">
                                <img id="thumbnail-img" src="/placeholder.svg" alt="Thumbnail Preview"
                                    class="w-20 h-20 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                            </div>
                        </div>

                        <!-- Images -->
                        <div>
                            <label for="images" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Gambar Galeri
                            </label>

                            <!-- Current Images -->
                            @if ($service->images && $service->images->count() > 0)
                                <div class="mb-3">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Gambar saat ini:</p>
                                    <div class="grid grid-cols-3 gap-2" id="existing-images">
                                        @foreach ($service->images as $image)
                                            <div class="relative" id="existing-image-{{ $image->id }}"
                                                data-image-id="{{ $image->id }}">
                                                <img src="{{ asset('assets/images/services/' . $image->image) }}"
                                                    alt="Service Image"
                                                    class="w-full h-16 object-cover rounded border border-gray-300 dark:border-gray-600">
                                                <button type="button"
                                                    onclick="markImageForDeletion({{ $image->id }})"
                                                    class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white rounded-full text-xs hover:bg-red-600 flex items-center justify-center transition-colors duration-200"
                                                    title="Hapus gambar">
                                                    ×
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div id="deletion-info" class="mt-2 text-sm text-red-600 dark:text-red-400 hidden">
                                        <span id="deletion-count">0</span> gambar akan dihapus saat form disimpan.
                                    </div>
                                </div>
                            @endif

                            <input type="file" name="images[]" id="images" accept="image/*" multiple
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                onchange="previewImages(this)">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG atau JPEG (MAX. 2MB per
                                file). Tambah gambar baru atau kosongkan jika tidak ingin menambah gambar.</p>

                            <div id="images-preview" class="mt-2 grid grid-cols-3 gap-2"></div>
                        </div>
                    </div>

                    <!-- Varian Layanan -->
                    <div class="mt-6">
                        <div class="flex items-center mb-4">
                            <input type="checkbox" id="has_variants" name="has_variants" value="1"
                                {{ $service->variants->count() > 0 ? 'checked' : '' }}
                                class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                onchange="toggleVariants()">
                            <label for="has_variants" class="ml-2 text-sm font-medium text-gray-900 dark:text-white">
                                Apakah layanan ini memiliki varian?
                            </label>
                        </div>

                        <div id="variants-section" class="{{ $service->variants->count() > 0 ? '' : 'hidden' }}">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Varian Layanan
                            </label>
                            <div class="flex gap-2 mb-3">
                                <input type="text" id="variant-name-input" placeholder="Nama varian..."
                                    class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <input type="number" id="variant-price-input" placeholder="Harga..."
                                    class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <button type="button" onclick="addVariant()"
                                    class="px-3 py-2 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    +
                                </button>
                            </div>
                            <div id="variants-list" class="space-y-1 max-h-32 overflow-y-auto"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <!-- Termasuk -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Termasuk Dalam Perjalanan
                            </label>
                            <div class="flex gap-2 mb-3">
                                <input type="text" id="includes-input"
                                    class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Item yang termasuk...">
                                <button type="button" onclick="addInclude()"
                                    class="px-3 py-2 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    +
                                </button>
                            </div>
                            <div id="includes-list" class="space-y-1 max-h-32 overflow-y-auto"></div>
                        </div>

                        <!-- Tidak Termasuk -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Tidak Termasuk Dalam Perjalanan
                            </label>
                            <div class="flex gap-2 mb-3">
                                <input type="text" id="excludes-input"
                                    class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Item yang tidak termasuk...">
                                <button type="button" onclick="addExclude()"
                                    class="px-3 py-2 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    +
                                </button>
                            </div>
                            <div id="excludes-list" class="space-y-1 max-h-32 overflow-y-auto"></div>
                        </div>
                    </div>

                    <!-- Detail dengan Summernote (Full Width) -->
                    <div class="mt-6">
                        <label for="detail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Detail Layanan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="detail" id="detail" required></textarea>
                    </div>

                    <!-- Rencana Perjalanan (Full Width) -->
                    <div class="mt-6">
                        <label for="travel_plan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Rencana Perjalanan
                        </label>
                        <textarea name="travel_plan" id="travel_plan">{{ old('travel_plan', $service->travel_plan) }}</textarea>
                    </div>

                    <!-- Syarat dan Ketentuan (Full Width) -->
                    <div class="mt-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Syarat dan Ketentuan
                        </label>
                        <div class="flex gap-2 mb-3">
                            <input type="text" id="requirements-input"
                                class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Syarat dan ketentuan...">
                            <button type="button" onclick="addRequirement()"
                                class="px-3 py-2 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                +
                            </button>
                        </div>
                        <div id="requirements-list" class="space-y-1 max-h-32 overflow-y-auto"></div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-2 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('admin.services.index') }}"
                            class="px-6 py-2.5 text-sm font-medium text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Simpan Layanan
                            <svg class="w-5 h-5 text-gray-800 dark:text-white inline ml-1.5" fill="currentColor"
                                viewBox="0 0 24 24">
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
            background-color: #374151 !important;
            color: #f9fafb !important;
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

        /* Enhanced color picker styling for dark mode */
        .dark .note-color .note-recent-color,
        .dark .note-color .note-color-palette {
            background-color: #374151 !important;
            border: 1px solid #4b5563 !important;
        }

        .dark .note-color-palette {
            background-color: #374151 !important;
        }

        .dark .note-color-palette .note-color-row {
            background-color: #374151 !important;
        }

        .dark .note-color-palette .note-color-btn {
            border: 1px solid #6b7280 !important;
        }

        .dark .note-color-palette .note-color-btn:hover {
            transform: scale(1.1);
            border-color: #9ca3af !important;
        }

        /* Dropdown menus in dark mode */
        .dark .note-dropdown-menu {
            background-color: #374151 !important;
            border: 1px solid #4b5563 !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3) !important;
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
            border: 1px solid #4b5563 !important;
        }

        .dark .note-toolbar select option {
            background-color: #374151 !important;
            color: #f9fafb !important;
        }

        /* Modal dialogs in dark mode */
        .dark .modal-content {
            background-color: #374151 !important;
            color: #f9fafb !important;
            border: 1px solid #4b5563 !important;
        }

        .dark .modal-header {
            border-bottom: 1px solid #4b5563 !important;
            background-color: #1f2937 !important;
        }

        .dark .modal-footer {
            border-top: 1px solid #4b5563 !important;
            background-color: #1f2937 !important;
        }

        .dark .modal-title {
            color: #f9fafb !important;
        }

        /* Input fields in modals */
        .dark .modal-content input,
        .dark .modal-content textarea,
        .dark .modal-content select {
            background-color: #1f2937 !important;
            color: #f9fafb !important;
            border: 1px solid #4b5563 !important;
        }

        .dark .modal-content input:focus,
        .dark .modal-content textarea:focus,
        .dark .modal-content select:focus {
            border-color: #6b7280 !important;
            box-shadow: 0 0 0 1px #6b7280 !important;
        }

        /* Fix for color palette visibility */
        .dark .note-color-palette,
        .dark .note-recent-color {
            z-index: 1050 !important;
        }

        /* Ensure color buttons are visible */
        .dark .note-color-btn {
            opacity: 1 !important;
            visibility: visible !important;
        }

        /* Style dropdown for style tool */
        .dark .note-style .dropdown-style {
            background-color: #374151 !important;
            color: #f9fafb !important;
            border: 1px solid #4b5563 !important;
        }

        .dark .note-style .dropdown-style .dropdown-item {
            color: #f9fafb !important;
        }

        .dark .note-style .dropdown-style .dropdown-item:hover {
            background-color: #4b5563 !important;
        }

        /* Fix for list tools */
        .dark .note-para .note-btn {
            background-color: transparent !important;
        }

        .dark .note-para .note-btn:hover {
            background-color: #374151 !important;
        }

        /* Image deletion styles */
        .image-marked-for-deletion {
            opacity: 0.4;
            position: relative;
        }

        .image-marked-for-deletion::after {
            content: 'AKAN DIHAPUS';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(239, 68, 68, 0.9);
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            z-index: 10;
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
            $('#detail').summernote({
                height: 200,
                placeholder: 'Masukkan detail layanan...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                styleTags: [
                    'p',
                    {
                        title: 'Blockquote',
                        tag: 'blockquote',
                        className: 'blockquote',
                        value: 'blockquote'
                    },
                    'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
                ],
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma',
                    'Times New Roman', 'Verdana'
                ],
                fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '22', '24', '36', '48'],
                callbacks: {
                    onInit: function() {
                        // Apply dark theme styles after initialization
                        if (isDarkMode()) {
                            applyDarkTheme();
                        }

                        // Fix color palette positioning
                        fixColorPalette();
                    },
                    onImageUpload: function(files) {
                        // Handle image upload if needed
                        console.log('Image upload:', files);
                    }
                }
            });

            $('#travel_plan').summernote({
                height: 200,
                placeholder: 'Masukkan rencana perjalanan...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                styleTags: [
                    'p',
                    {
                        title: 'Blockquote',
                        tag: 'blockquote',
                        className: 'blockquote',
                        value: 'blockquote'
                    },
                    'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
                ],
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma',
                    'Times New Roman', 'Verdana'
                ],
                fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '22', '24', '36', '48'],
                callbacks: {
                    onInit: function() {
                        // Apply dark theme styles after initialization
                        if (isDarkMode()) {
                            applyDarkTheme();
                        }

                        // Fix color palette positioning
                        fixColorPalette();
                    },
                    onImageUpload: function(files) {
                        // Handle image upload if needed
                        console.log('Image upload:', files);
                    }
                }
            });
        }

        // Function to apply dark theme to Summernote
        function applyDarkTheme() {
            const $noteEditor = $('.note-editor');
            const $noteToolbar = $('.note-toolbar');
            const $noteEditingArea = $('.note-editing-area');

            // Add dark class to trigger CSS rules
            $noteEditor.addClass('dark-theme');
            $noteToolbar.addClass('dark-theme');
            $noteEditingArea.addClass('dark-theme');

            // Force dark mode styles
            setTimeout(() => {
                $('.note-editing-area').css({
                    'background-color': '#374151',
                    'color': '#f9fafb'
                });
            }, 100);
        }

        // Function to remove dark theme from Summernote
        function removeDarkTheme() {
            const $noteEditor = $('.note-editor');
            const $noteToolbar = $('.note-toolbar');
            const $noteEditingArea = $('.note-editing-area');

            // Remove dark class
            $noteEditor.removeClass('dark-theme');
            $noteToolbar.removeClass('dark-theme');
            $noteEditingArea.removeClass('dark-theme');
        }

        // Function to fix color palette visibility
        function fixColorPalette() {
            // Ensure color palette is properly styled
            $(document).on('click', '.note-color .note-dropdown-toggle', function() {
                setTimeout(() => {
                    if (isDarkMode()) {
                        $('.note-color-palette, .note-recent-color').css({
                            'background-color': '#374151',
                            'border': '1px solid #4b5563',
                            'z-index': '1050'
                        });

                        $('.note-color-btn').css({
                            'opacity': '1',
                            'visibility': 'visible',
                            'border': '1px solid #6b7280'
                        });
                    }
                }, 50);
            });
        }

        $(document).ready(function() {
            // Initialize Summernote
            initSummernote();

            // Set existing content for Summernote
            $('#detail').summernote('code', {!! json_encode(old('detail', $service->detail)) !!});

            // Initialize existing includes, excludes, variants, and requirements
            updateIncludesList();
            updateExcludesList();
            updateVariantsList();
            updateRequirementsList();

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
                // Small delay to ensure DOM is updated
                setTimeout(function() {
                    if (isDarkMode()) {
                        applyDarkTheme();
                    } else {
                        removeDarkTheme();
                    }
                }, 100);
            });
        });

        // Thumbnail Preview
        function previewThumbnail(input) {
            const preview = document.getElementById('thumbnail-preview');
            const img = document.getElementById('thumbnail-img');

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

        // Multiple Images Preview
        function previewImages(input) {
            const preview = document.getElementById('images-preview');
            preview.innerHTML = '';

            if (input.files) {
                Array.from(input.files).forEach((file, index) => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative';
                        div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview ${index + 1}" 
                             class="w-full h-16 object-cover rounded border border-gray-300 dark:border-gray-600">
                        <button type="button" onclick="removeImagePreview(this, ${index})" 
                                class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white rounded-full text-xs hover:bg-red-600 flex items-center justify-center">
                            ×
                        </button>
                    `;
                        preview.appendChild(div);
                    }

                    reader.readAsDataURL(file);
                });
            }
        }

        function removeImagePreview(button, index) {
            button.parentElement.remove();
        }

        // Enhanced Image deletion for existing images
        let imagesToDelete = [];

        function markImageForDeletion(imageId) {
            // Prevent double marking
            if (imagesToDelete.includes(imageId)) {
                return;
            }

            imagesToDelete.push(imageId);
            const imageElement = document.getElementById('existing-image-' + imageId);

            // Add visual feedback class
            imageElement.classList.add('image-marked-for-deletion');

            // Change button to show it's marked for deletion
            const button = imageElement.querySelector('button');
            button.style.backgroundColor = '#dc2626';
            button.innerHTML = '↶';
            button.title = 'Batalkan penghapusan';
            button.onclick = function() {
                unmarkImageForDeletion(imageId);
            };

            // Add hidden input for image deletion
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_images[]';
            input.value = imageId;
            input.id = 'delete-input-' + imageId;
            document.getElementById('service-form').appendChild(input);

            // Update deletion info
            updateDeletionInfo();
        }

        function unmarkImageForDeletion(imageId) {
            // Remove from array
            const index = imagesToDelete.indexOf(imageId);
            if (index > -1) {
                imagesToDelete.splice(index, 1);
            }

            const imageElement = document.getElementById('existing-image-' + imageId);

            // Remove visual feedback class
            imageElement.classList.remove('image-marked-for-deletion');

            // Restore button
            const button = imageElement.querySelector('button');
            button.style.backgroundColor = '#ef4444';
            button.innerHTML = '×';
            button.title = 'Hapus gambar';
            button.onclick = function() {
                markImageForDeletion(imageId);
            };

            // Remove hidden input
            const input = document.getElementById('delete-input-' + imageId);
            if (input) {
                input.remove();
            }

            // Update deletion info
            updateDeletionInfo();
        }

        function updateDeletionInfo() {
            const deletionInfo = document.getElementById('deletion-info');
            const deletionCount = document.getElementById('deletion-count');

            if (imagesToDelete.length > 0) {
                deletionCount.textContent = imagesToDelete.length;
                deletionInfo.classList.remove('hidden');
            } else {
                deletionInfo.classList.add('hidden');
            }
        }

        // Toggle Variants Section
        function toggleVariants() {
            const checkbox = document.getElementById('has_variants');
            const section = document.getElementById('variants-section');

            if (checkbox.checked) {
                section.classList.remove('hidden');
            } else {
                section.classList.add('hidden');
                // Clear variants when hiding
                variantsItems = [];
                updateVariantsList();
            }
        }

        // Variants List Management
        let variantsItems = @json(
            $service->variants->map(function ($variant) {
                    return ['name' => $variant->name, 'price' => $variant->price];
                })->toArray() ?? []
        );

        function addVariant() {
            const nameInput = document.getElementById('variant-name-input');
            const priceInput = document.getElementById('variant-price-input');
            const name = nameInput.value.trim();
            const price = priceInput.value.trim();

            if (name && price) {
                variantsItems.push({
                    name: name,
                    price: price
                });
                updateVariantsList();
                nameInput.value = '';
                priceInput.value = '';
            }
        }

        function removeVariant(index) {
            variantsItems.splice(index, 1);
            updateVariantsList();
        }

        function updateVariantsList() {
            const list = document.getElementById('variants-list');
            list.innerHTML = '';

            variantsItems.forEach((item, index) => {
                const div = document.createElement('div');
                div.className = 'flex items-center justify-between p-2 bg-gray-50 dark:bg-gray-700 rounded text-sm';
                div.innerHTML = `
                <span class="text-gray-900 dark:text-white flex-1">${item.name} - Rp ${parseInt(item.price).toLocaleString('id-ID')}</span>
                <button type="button" onclick="removeVariant(${index})" 
                        class="text-red-500 hover:text-red-700 ml-2">
                    ×
                </button>
                <input type="hidden" name="variant_names[]" value="${item.name}">
                <input type="hidden" name="variant_prices[]" value="${item.price}">
            `;
                list.appendChild(div);
            });
        }

        // Includes List Management
        let includesItems = @json($service->includes->pluck('include')->toArray() ?? []);

        function addInclude() {
            const input = document.getElementById('includes-input');
            const value = input.value.trim();

            if (value) {
                includesItems.push(value);
                updateIncludesList();
                input.value = '';
            }
        }

        function removeInclude(index) {
            includesItems.splice(index, 1);
            updateIncludesList();
        }

        function updateIncludesList() {
            const list = document.getElementById('includes-list');
            list.innerHTML = '';

            includesItems.forEach((item, index) => {
                const div = document.createElement('div');
                div.className = 'flex items-center justify-between p-2 bg-gray-50 dark:bg-gray-700 rounded text-sm';
                div.innerHTML = `
                <span class="text-gray-900 dark:text-white flex-1">${item}</span>
                <button type="button" onclick="removeInclude(${index})" 
                        class="text-red-500 hover:text-red-700 ml-2">
                    ×
                </button>
                <input type="hidden" name="includes[]" value="${item}">
            `;
                list.appendChild(div);
            });
        }

        // Excludes List Management
        let excludesItems = @json($service->excludes->pluck('exclude')->toArray() ?? []);

        function addExclude() {
            const input = document.getElementById('excludes-input');
            const value = input.value.trim();

            if (value) {
                excludesItems.push(value);
                updateExcludesList();
                input.value = '';
            }
        }

        function removeExclude(index) {
            excludesItems.splice(index, 1);
            updateExcludesList();
        }

        function updateExcludesList() {
            const list = document.getElementById('excludes-list');
            list.innerHTML = '';

            excludesItems.forEach((item, index) => {
                const div = document.createElement('div');
                div.className = 'flex items-center justify-between p-2 bg-gray-50 dark:bg-gray-700 rounded text-sm';
                div.innerHTML = `
                <span class="text-gray-900 dark:text-white flex-1">${item}</span>
                <button type="button" onclick="removeExclude(${index})" 
                        class="text-red-500 hover:text-red-700 ml-2">
                    ×
                </button>
                <input type="hidden" name="excludes[]" value="${item}">
            `;
                list.appendChild(div);
            });
        }

        // Requirements List Management
        let requirementsItems = @json($service->requirements->pluck('requirement')->toArray() ?? []);

        function addRequirement() {
            const input = document.getElementById('requirements-input');
            const value = input.value.trim();

            if (value) {
                requirementsItems.push(value);
                updateRequirementsList();
                input.value = '';
            }
        }

        function removeRequirement(index) {
            requirementsItems.splice(index, 1);
            updateRequirementsList();
        }

        function updateRequirementsList() {
            const list = document.getElementById('requirements-list');
            list.innerHTML = '';

            requirementsItems.forEach((item, index) => {
                const div = document.createElement('div');
                div.className = 'flex items-center justify-between p-2 bg-gray-50 dark:bg-gray-700 rounded text-sm';
                div.innerHTML = `
                <span class="text-gray-900 dark:text-white flex-1">${item}</span>
                <button type="button" onclick="removeRequirement(${index})" 
                        class="text-red-500 hover:text-red-700 ml-2">
                    ×
                </button>
                <input type="hidden" name="requirements[]" value="${item}">
            `;
                list.appendChild(div);
            });
        }

        // Allow Enter key to add items
        document.getElementById('includes-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addInclude();
            }
        });

        document.getElementById('excludes-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addExclude();
            }
        });

        document.getElementById('requirements-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addRequirement();
            }
        });

        document.getElementById('variant-name-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('variant-price-input').focus();
            }
        });

        document.getElementById('variant-price-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addVariant();
            }
        });

        // Enhanced Form submission validation
        document.getElementById('service-form').addEventListener('submit', function(e) {
            // Basic validation
            const requiredFields = ['title', 'type_of_service', 'price', 'prolog'];
            let isValid = true;

            requiredFields.forEach(field => {
                const input = document.getElementById(field);
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add('border-red-500');
                } else {
                    input.classList.remove('border-red-500');
                }
            });

            // Check Summernote content
            const summernoteContent = $('#detail').summernote('code');
            if (!summernoteContent.trim() || summernoteContent === '<p><br></p>') {
                isValid = false;
                $('.note-editor').addClass('border-red-500');
            } else {
                $('.note-editor').removeClass('border-red-500');
            }

            if (!isValid) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi.');
                return;
            }

            // Confirm image deletion if any images are marked
            if (imagesToDelete.length > 0) {
                const confirmDelete = confirm(
                    `Anda akan menghapus ${imagesToDelete.length} gambar. Gambar yang dihapus tidak dapat dikembalikan. Apakah Anda yakin ingin melanjutkan?`
                );
                if (!confirmDelete) {
                    e.preventDefault();
                    return;
                }
            }

            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            submitButton.disabled = true;
            submitButton.innerHTML = 'Menyimpan...';

            // Re-enable button after 10 seconds as fallback
            setTimeout(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            }, 10000);
        });
    </script>
@endpush
