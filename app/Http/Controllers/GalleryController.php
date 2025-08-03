<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Gallery::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $galleries = $query->latest()->paginate(10);

        $viewData = [
            'title' => 'Gallery',
            'galleries' => $galleries,
        ];

        return view('admin.galleries.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $viewData = [
            'title' => 'Tambah Gallery',
        ];

        return view('admin.galleries.add', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->validateGallery($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['title', 'prolog', 'status']);
        $data['status'] = $request->status ?? 1;

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->uploadImage($request->file('thumbnail'), 'thumbnails');
        }

        Gallery::create($data);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);

        $viewData = [
            'title' => 'Detail Gallery',
            'gallery' => $gallery,
        ];

        return view('admin.galleries.detail', $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);

        $viewData = [
            'title' => 'Edit Gallery',
            'gallery' => $gallery,
        ];

        return view('admin.galleries.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateGallery($request, $id);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $gallery = Gallery::findOrFail($id);

        $data = $request->only(['title', 'prolog', 'status']);
        $data['status'] = $request->status ?? 1;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($gallery->image) {
                $this->deleteImage($gallery->image);
            }
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($gallery->thumbnail) {
                $this->deleteImage($gallery->thumbnail, 'thumbnails');
            }
            $data['thumbnail'] = $this->uploadImage($request->file('thumbnail'), 'thumbnails');
        }

        $gallery->update($data);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Hapus gambar jika ada
        if ($gallery->image) {
            $this->deleteImage($gallery->image);
        }

        if ($gallery->thumbnail) {
            $this->deleteImage($gallery->thumbnail, 'thumbnails');
        }

        $gallery->delete();

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery berhasil dihapus.');
    }

    /**
     * Validate gallery data
     */
    private function validateGallery(Request $request, $id = null)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'prolog' => 'required|string',
            'status' => 'nullable|in:0,1',
            'image' => $id ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'thumbnail' => $id ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        $messages = [
            'title.required' => 'Judul wajib diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'prolog.required' => 'Prolog wajib diisi.',
            'image.required' => 'Gambar wajib diupload.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
            'thumbnail.required' => 'Thumbnail wajib diupload.',
            'thumbnail.image' => 'File harus berupa gambar.',
            'thumbnail.mimes' => 'Format thumbnail harus jpeg, png, jpg, atau gif.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 2MB.'
        ];

        return Validator::make($request->all(), $rules, $messages);
    }

    /**
     * Upload image to storage
     */
    private function uploadImage($file, $subfolder = 'images')
    {
        $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('assets/images/galleries/' . $subfolder);

        // Buat direktori jika belum ada
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $file->move($destinationPath, $fileName);

        return $fileName;
    }

    /**
     * Delete image from storage
     */
    private function deleteImage($fileName, $subfolder = 'images')
    {
        $filePath = public_path('assets/images/galleries/' . $subfolder . '/' . $fileName);

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    /**
     * Get image URL
     */
    public function getImageUrl($fileName, $subfolder = 'images')
    {
        if ($fileName) {
            return asset('assets/images/galleries/' . $subfolder . '/' . $fileName);
        }

        return asset('assets/images/default-image.jpg');
    }

    /**
     * Get thumbnail URL
     */
    public function getThumbnailUrl($fileName)
    {
        return $this->getImageUrl($fileName, 'thumbnails');
    }
}
