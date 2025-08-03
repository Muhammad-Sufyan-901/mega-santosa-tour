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
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Edit
                                    Galeri</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Edit Galeri</h1>
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

                <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Judul Galeri -->
                        <div>
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Judul Galeri <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="title" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white @error('title') border-red-500 @enderror"
                                placeholder="Masukkan judul galeri" value="{{ old('title', $gallery->title) }}">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Status
                            </label>
                            <select name="status" id="status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                <option value="1" {{ old('status', $gallery->status) == '1' ? 'selected' : '' }}>
                                    Aktif</option>
                                <option value="0" {{ old('status', $gallery->status) == '0' ? 'selected' : '' }}>
                                    Nonaktif</option>
                            </select>
                        </div>

                        <!-- Thumbnail -->
                        <div>
                            <label for="thumbnail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Thumbnail Baru
                            </label>
                            <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 @error('thumbnail') border-red-500 @enderror"
                                onchange="previewThumbnail(this)">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG atau JPEG (MAX. 2MB).
                                Kosongkan jika tidak ingin mengubah.</p>
                            @error('thumbnail')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror

                            <!-- Current Thumbnail -->
                            @if ($gallery->thumbnail)
                                <div class="mt-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white mb-2">Thumbnail Saat Ini:
                                    </p>
                                    <img src="{{ asset('assets/images/galleries/thumbnails/' . $gallery->thumbnail) }}"
                                        alt="Current Thumbnail"
                                        class="w-20 h-20 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                                </div>
                            @endif

                            <!-- New Thumbnail Preview -->
                            <div id="thumbnail-preview" class="mt-3 hidden">
                                <p class="text-sm font-medium text-gray-900 dark:text-white mb-2">Preview Thumbnail Baru:
                                </p>
                                <img id="thumbnail-img" src="/placeholder.svg" alt="Thumbnail Preview"
                                    class="w-20 h-20 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                            </div>
                        </div>

                        <!-- Image -->
                        <div>
                            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Gambar Utama Baru
                            </label>
                            <input type="file" name="image" id="image" accept="image/*"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 @error('image') border-red-500 @enderror"
                                onchange="previewImage(this)">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG atau JPEG (MAX. 2MB).
                                Kosongkan jika tidak ingin mengubah.</p>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror

                            <!-- Current Image -->
                            @if ($gallery->image)
                                <div class="mt-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white mb-2">Gambar Saat Ini:</p>
                                    <img src="{{ asset('assets/images/galleries/images/' . $gallery->image) }}"
                                        alt="Current Image"
                                        class="w-20 h-20 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                                </div>
                            @endif

                            <!-- New Image Preview -->
                            <div id="image-preview" class="mt-3 hidden">
                                <p class="text-sm font-medium text-gray-900 dark:text-white mb-2">Preview Gambar Baru:</p>
                                <img id="image-img" src="/placeholder.svg" alt="Image Preview"
                                    class="w-20 h-20 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                            </div>
                        </div>
                    </div>

                    <!-- Prolog (Full Width) -->
                    <div class="mt-6">
                        <label for="prolog" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Prolog/Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea name="prolog" id="prolog" rows="4" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white @error('prolog') border-red-500 @enderror"
                            placeholder="Masukkan deskripsi galeri...">{{ old('prolog', $gallery->prolog) }}</textarea>
                        @error('prolog')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-2 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('admin.galleries.index') }}"
                            class="px-6 py-2.5 text-sm font-medium text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300">
                            Update Galeri
                            <svg class="w-5 h-5 inline ml-1.5" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M5 8a4 4 0 1 1 7.796 1.263l-2.533 2.534A4 4 0 0 1 5 8Zm4.06 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h2.172a2.999 2.999 0 0 1-.114-1.588l.674-3.372a3 3 0 0 1 .82-1.533L9.06 13Zm9.032-5a2.907 2.907 0 0 0-2.056.852L9.967 14.92a1 1 0 0 0-.273.51l-.675 3.373a1 1 0 0 0 1.177 1.177l3.372-.675a1 1 0 0 0 .511-.273l6.07-6.07a2.91 2.91 0 0 0-.852-4.787Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
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

        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const img = document.getElementById('image-img');

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
    </script>
@endpush
